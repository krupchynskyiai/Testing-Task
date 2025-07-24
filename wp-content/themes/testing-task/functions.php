<?php
/**
 * Testing Task functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Testing_Task
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function testing_task_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Testing Task, use a find and replace
		* to change 'testing-task' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'testing-task', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'testing-task' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'testing_task_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'testing_task_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function testing_task_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'testing_task_content_width', 640 );
}
add_action( 'after_setup_theme', 'testing_task_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function testing_task_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'testing-task' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'testing-task' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'testing_task_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function testing_task_scripts() {
	wp_enqueue_style( 'testing-task-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'testing-task-style', 'rtl', 'replace' );

	wp_enqueue_script( 'testing-task-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'testing-task-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'testing_task_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function theme_register_car_catalog_block() {
    register_block_type( get_template_directory() . '/blocks/car-catalog', [
        'render_callback' => 'render_car_catalog_callback',
    ]);
}
add_action('init', 'theme_register_car_catalog_block');

function render_car_catalog_callback($attributes, $content) {
    ob_start();
    ?>
    <div id="car-catalog-frontend"></div>
    <?php
    return ob_get_clean();
}

function register_my_menus() {
  register_nav_menus(
      array(
          'header-menu' => __( 'Header Menu' ),
          'footer-menu' => __( 'Footer Menu' )
      )
  );
}

add_action( 'init', 'register_my_menus' ); 

function testing_task_enqueue_admin_scripts($hook) {
    if ($hook !== 'settings_page_testing-task-general-settings') {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script(
        'testing-task-admin-media',
        get_template_directory_uri() . '/assets/js/admin-media.js',
        ['jquery'],
        null,
        true
    );
}
add_action('admin_enqueue_scripts', 'testing_task_enqueue_admin_scripts');

function testing_task_register_general_settings_page() {
    add_options_page(
        'General Settings',
        'General Settings',
        'manage_options',
        'testing-task-general-settings',
        'testing_task_general_settings_callback'
    );
}
add_action('admin_menu', 'testing_task_register_general_settings_page');

function testing_task_general_settings_callback() {
    ?>
    <div class="wrap">
        <h1>General Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('testing_task_general_settings_group');
            do_settings_sections('testing-task-general-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function testing_task_register_general_settings() {
    register_setting('testing_task_general_settings_group', 'testing_task_site_logo');
    
    register_setting('testing_task_general_settings_group', 'testing_task_site_phone', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '',
    ]);

    add_settings_section(
        'testing_task_general_section',
        'Основні налаштування',
        null,
        'testing-task-general-settings'
    );

    add_settings_field(
        'testing_task_site_logo',
        'Логотип сайту',
        'testing_task_site_logo_render',
        'testing-task-general-settings',
        'testing_task_general_section'
    );

    add_settings_field(
        'testing_task_site_phone',
        'Номер телефону',
        'testing_task_site_phone_render',
        'testing-task-general-settings',
        'testing_task_general_section'
    );
}
add_action('admin_init', 'testing_task_register_general_settings');

function testing_task_site_phone_render() {
    $value = get_option('testing_task_site_phone', '');
    echo '<input type="text" name="testing_task_site_phone" value="' . esc_attr($value) . '" class="regular-text" />';
}

function testing_task_site_logo_render() {
    $logo_id = get_option('testing_task_site_logo');
    $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : ''; ?>
    <?php print_r($logo_url);?>
		<div style="mb-4">
    	<img id="logo-preview" src="<?php esc_url($logo_url) ?>" />
    </div>

    <input type="hidden" id="testing_task_site_logo" name="testing_task_site_logo" value="<?php esc_attr($logo_id) ?>" />
    <button type="button" class="button" id="upload_logo_button">Upload Logo</button>
    <button type="button" class="button" id="remove_logo_button">Remove</button>
		
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const uploadBtn = document.getElementById("upload_logo_button");
            const removeBtn = document.getElementById("remove_logo_button");
            const preview = document.getElementById("logo-preview");
            const hiddenInput = document.getElementById("testing_task_site_logo");

            uploadBtn.addEventListener("click", function (e) {
                e.preventDefault();
                const frame = wp.media({
                    title: "Select logo",
                    button: { text: "Select" },
                    multiple: false
                });
                frame.on("select", function () {
                    const attachment = frame.state().get("selection").first().toJSON();
                    hiddenInput.value = attachment.id;
                    preview.src = attachment.url;
                    preview.style.display = "block";
                });
                frame.open();
            });

            removeBtn.addEventListener("click", function () {
                hiddenInput.value = "";
                preview.src = "";
                preview.style.display = "none";
            });
        });
    </script>
    <?php
}

function testing_task_allow_svg_uploads($mimes) {
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'testing_task_allow_svg_uploads');

class Testing_Task_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $classes = 'list-none h-fit';
    $output .= '<li class="' . $classes . '">';
    $output .= '<a href="' . esc_attr( $item->url ) . '">' . $item->title . '</a>';
  }

  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }
}

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

	wp_enqueue_script( 'testing-task-main', get_template_directory_uri() . '/build/js/main.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'testing-task-build-js', get_template_directory_uri() . '/build/js/slider.js', array(), _S_VERSION, true );

    wp_enqueue_script( 'testing-task-all-blocks-js', get_template_directory_uri() . '/build/js/blocks/all-blocks.js', array(), _S_VERSION, true );

    wp_localize_script('testing-task-all-blocks-js', 'secretData', array(
        'apiToken' => defined('API_TOKEN') ? API_TOKEN : ''
    ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'testing_task_scripts' );

function testing_task_register_blocks() {
    wp_register_script(
        'testing-task-catalog-editor',
        get_template_directory_uri() . '/build/js/index.js',
        [ 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor' ],
        filemtime( get_template_directory() . '/build/js/index.js' ),
        true
    );

    register_block_type( 'testing-task/catalog', [
        'editor_script' => 'testing-task-catalog-editor',
    ]);
}
add_action( 'init', 'testing_task_register_blocks' );


add_action('wp_enqueue_scripts', function () {
    if (has_block('testing-task/catalog')) {
        wp_enqueue_script(
            'testing-task-catalog-frontend',
            get_template_directory_uri() . '/build/js/blocks/catalog/frontend.js',
            [ 'wp-element' ],
            filemtime(get_template_directory() . '/build/js/blocks/catalog/frontend.js'),
            true
        );
        wp_localize_script('testing-task-catalog-frontend', 'secretData', array(
            'apiToken' => defined('API_TOKEN') ? API_TOKEN : ''
        ));
    }
});


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

require_once get_template_directory() . '/template-parts/blocks/blocks.php';

add_action('init', 'acf_blocks_init');

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

    register_setting('testing_task_general_settings_group', 'testing_task_copyright', [
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

    add_settings_field(
        'testing_task_copyright',
        'Копірайт',
        'testing_task_site_copyright_render',
        'testing-task-general-settings',
        'testing_task_general_section'
    );
}
add_action('admin_init', 'testing_task_register_general_settings');

function testing_task_site_phone_render() {
    $value = get_option('testing_task_site_phone', '');
    echo '<input type="text" name="testing_task_site_phone" value="' . esc_attr($value) . '" class="regular-text" />';
}

function testing_task_site_copyright_render() {
    $value = get_option('testing_task_copyright', '');
    echo '<input type="text" name="testing_task_copyright" value="' . esc_attr($value) . '" class="regular-text" />';
}

function testing_task_site_logo_render() {
    $logo_id = get_option('testing_task_site_logo');
    $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : '';
    ?>
    <div class="mb-4">
      <img id="logo-preview" src="<?php echo esc_url($logo_url); ?>" style="<?php echo $logo_url ? 'display:block;' : 'display:none;'; ?>" />
    </div>

    <input type="hidden" id="testing_task_site_logo" name="testing_task_site_logo" value="<?php echo esc_attr($logo_id); ?>" />
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

function catalog_rewrite_rules() {
    add_rewrite_rule('^catalog/brand/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/?$', 'index.php?pagename=catalog&category=$matches[1]', 'top');
    add_rewrite_rule('^catalog/sort/([^/]+)/?$', 'index.php?pagename=catalog&sort=$matches[1]', 'top');
    add_rewrite_rule('^catalog/search/([^/]+)/?$', 'index.php?pagename=catalog&search=$matches[1]', 'top');
    add_rewrite_rule('^catalog/page/([0-9]+)/?$', 'index.php?pagename=catalog&paged=$matches[1]', 'top');

    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/sort/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&sort=$matches[2]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&search=$matches[2]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/sort/([^/]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&sort=$matches[2]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&search=$matches[2]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('^catalog/sort/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&sort=$matches[1]&search=$matches[2]', 'top');
    add_rewrite_rule('^catalog/sort/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&sort=$matches[1]&paged=$matches[2]', 'top');
    add_rewrite_rule('^catalog/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&search=$matches[1]&paged=$matches[2]', 'top');

    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/sort/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&sort=$matches[3]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&search=$matches[3]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&paged=$matches[3]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/sort/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&sort=$matches[2]&search=$matches[3]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/sort/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&sort=$matches[2]&paged=$matches[3]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&search=$matches[2]&paged=$matches[3]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/sort/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&sort=$matches[2]&search=$matches[3]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/sort/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&sort=$matches[2]&paged=$matches[3]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&search=$matches[2]&paged=$matches[3]', 'top');
    add_rewrite_rule('^catalog/sort/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&sort=$matches[1]&search=$matches[2]&paged=$matches[3]', 'top');

    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/sort/([^/]+)/search/([^/]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&sort=$matches[3]&search=$matches[4]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/sort/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&sort=$matches[3]&paged=$matches[4]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&search=$matches[3]&paged=$matches[4]', 'top');
    add_rewrite_rule('^catalog/brand/([^/]+)/sort/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&sort=$matches[2]&search=$matches[3]&paged=$matches[4]', 'top');
    add_rewrite_rule('^catalog/category/([^/]+)/sort/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&category=$matches[1]&sort=$matches[2]&search=$matches[3]&paged=$matches[4]', 'top');

    add_rewrite_rule('^catalog/brand/([^/]+)/category/([^/]+)/sort/([^/]+)/search/([^/]+)/page/([0-9]+)/?$', 'index.php?pagename=catalog&brand=$matches[1]&category=$matches[2]&sort=$matches[3]&search=$matches[4]&paged=$matches[5]', 'top');
}
add_action('init', 'catalog_rewrite_rules');

function catalog_query_vars($vars) {
    $vars[] = 'brand';
    $vars[] = 'category';
    $vars[] = 'sort';
    $vars[] = 'search';
    $vars[] = 'paged';
    return $vars;
}
add_filter('query_vars', 'catalog_query_vars');

add_action('rest_api_init', function () {
    register_rest_route('testing-task/v1', '/cars', [
        'methods'  => 'GET',
        'callback' => 'testing_task_get_cars',
        'permission_callback' => 'testing_task_check_token'
    ]);
});

function testing_task_check_token(WP_REST_Request $request) {
    $headers = $request->get_headers();

    if (empty($headers['authorization'])) {
        return new WP_Error('rest_forbidden', 'Authorization header missing', ['status' => 403]);
    }

    $auth = $headers['authorization'][0];

    if (stripos($auth, 'Bearer ') !== 0) {
        return new WP_Error('rest_forbidden', 'Invalid authorization header', ['status' => 403]);
    }

    $token = trim(str_ireplace('Bearer', '', $auth));

    if ($token !== API_TOKEN) {
        return new WP_Error('rest_forbidden', 'Invalid token', ['status' => 403]);
    }

    return true;
}

function testing_task_get_cars(WP_REST_Request $request) {
    $search   = $request->get_param('search');
    $brand    = $request->get_param('brand');
    $category = $request->get_param('category');
    $sort     = $request->get_param('sort');
    $page     = max(1, (int) $request->get_param('page'));
    $per_page = max(1, (int) $request->get_param('per_page', 9));

    $tax_query  = [];
    $post_ids   = [];
    $search_terms_exist = false;

    if ($brand) {
        $brand = explode(',', $brand);
        $tax_query[] = [
            'taxonomy' => 'car-brand',
            'field'    => 'slug',
            'terms'    => $brand,
        ];
    }

    if ($category) {
        $category = explode(',', $category);
        $tax_query[] = [
            'taxonomy' => 'car-category',
            'field'    => 'slug',
            'terms'    => $category,
        ];
    }

    if ($search && !$tax_query) {

        $meta_query = [
            [
                'key'     => 'description',
                'value'   => $search,
                'compare' => 'LIKE',
            ],
        ];

        $meta_query_ids = get_posts([
            'post_type'      => 'car',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            'meta_query'     => $meta_query,
        ]);

        $title_ids = get_posts([
            'post_type'      => 'car',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
            's'              => $search,
        ]);

        $meta_and_title_ids = array_unique(array_merge($meta_query_ids, $title_ids));
        if (!empty($meta_and_title_ids)) {
            $search_terms_exist = true;
        }

        $matching_brands = get_terms([
            'taxonomy'   => 'car-brand',
            'hide_empty' => false,
            'search'     => $search,
        ]);

        if (!empty($matching_brands) && !is_wp_error($matching_brands)) {
            $brand_slugs = wp_list_pluck($matching_brands, 'slug');
            if (!empty($brand_slugs)) {
                $tax_query[] = [
                    'taxonomy' => 'car-brand',
                    'field'    => 'slug',
                    'terms'    => $brand_slugs,
                ];
                $search_terms_exist = true;
            }
        }

        $matching_categories = get_terms([
            'taxonomy'   => 'car-category',
            'hide_empty' => false,
            'search'     => $search,
        ]);

        if (!empty($matching_categories) && !is_wp_error($matching_categories)) {
            $category_slugs = wp_list_pluck($matching_categories, 'slug');
            if (!empty($category_slugs)) {
                $tax_query[] = [
                    'taxonomy' => 'car-category',
                    'field'    => 'slug',
                    'terms'    => $category_slugs,
                ];
                $search_terms_exist = true;
            }
        }

        $tax_query_ids = [];
        if (!empty($tax_query)) {
            $tax_query_ids = get_posts([
                'post_type'      => 'car',
                'post_status'    => 'publish',
                'posts_per_page' => -1,
                'fields'         => 'ids',
                'tax_query'      => ['relation' => 'OR'] + $tax_query,
            ]);
        }

        $post_ids = array_unique(array_merge($meta_and_title_ids, $tax_query_ids));

        if (!$search_terms_exist) {
            $post_ids = [0];
        }
    } elseif ($search && $tax_query) {
        $meta_query = [
            'relation' => 'OR',
            [
                'key'     => 'description',
                'value'   => $search,
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'title',
                'value'   => $search,
                'compare' => 'LIKE',
            ],
        ];
    }

    $args = [
        'post_type'      => 'car',
        'posts_per_page' => $per_page,
        'paged'          => $page,
        'post_status'    => 'publish',
    ];

    if (!empty($meta_query)) {
    $args['meta_query'] = $meta_query;
}

    if (!empty($post_ids)) {
        $args['post__in'] = $post_ids;
        $args['orderby']  = 'post__in';
    } elseif (!empty($tax_query)) {
        $args['tax_query'] = count($tax_query) > 1
            ? array_merge(['relation' => 'AND'], $tax_query)
            : $tax_query;
    }

    switch ($sort) {
        case 'az':
            $args['orderby'] = 'title';
            $args['order']   = 'ASC';
            break;
        case 'za':
            $args['orderby'] = 'title';
            $args['order']   = 'DESC';
            break;
        case 'oldest':
            $args['orderby'] = 'date';
            $args['order']   = 'ASC';
            break;
        case 'expensive':
            $args['meta_key'] = 'price';
            $args['orderby']  = 'meta_value_num';
            $args['order']   = 'DESC';
            break;
        case 'cheap':
            $args['meta_key'] = 'price';
            $args['orderby']  = 'meta_value_num';
            $args['order']   = 'ASC';
            break;
        case 'newest':
        default:
            $args['orderby'] = 'date';
            $args['order']   = 'DESC';
            break;
    }

    $query = new WP_Query($args);
    $cars = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            $image = get_field('image', $post_id);
            $image_url = is_array($image) && isset($image['url']) ? $image['url'] : (is_string($image) ? $image : '');

            $brands     = get_the_terms($post_id, 'car-brand');
            $categories = get_the_terms($post_id, 'car-category');

            $cars[] = [
                'id'          => $post_id,
                'title'       => get_the_title($post_id),
                'description' => get_field('description', $post_id),
                'price'       => get_field('price', $post_id),
                'image'       => $image_url,
                'brand'       => $brands ? wp_list_pluck($brands, 'name') : [],
                'category'    => $categories ? wp_list_pluck($categories, 'name') : [],
                'link'        => get_permalink($post_id),
            ];
        }
        wp_reset_postdata();
    }

    $brands     = get_terms(['taxonomy' => 'car-brand', 'hide_empty' => false]);
    $categories = get_terms(['taxonomy' => 'car-category', 'hide_empty' => false]);

    return rest_ensure_response([
        'cars'         => $cars,
        'brands'       => wp_list_pluck($brands, 'name', 'slug'),
        'categories'   => wp_list_pluck($categories, 'name', 'slug'),
        'total_pages'  => $query->max_num_pages,
        'current_page' => $page,
    ]);
}


function testing_task_clear_cars_cache($post_id) {
    if (get_post_type($post_id) === 'car') {
        delete_transient('testing_task_cars_data');
    }
}
add_action('save_post', 'testing_task_clear_cars_cache');
add_action('deleted_post', 'testing_task_clear_cars_cache');
add_action('trashed_post', 'testing_task_clear_cars_cache');
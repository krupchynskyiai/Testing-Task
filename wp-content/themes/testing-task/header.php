<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Testing_Task
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php 
		$logo_id = get_option('testing_task_site_logo');
    $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : ''; 
	?>

	<header class='header bg-sky-500/30 border-b border-white/50 w-full'>
  <div class='container'>
    <div class='header__content py-4 flex items-center justify-between gap-4'>
      
      <img class='h-16 md:h-24' src='<?php echo esc_url($logo_url); ?>' alt='logo'>

      <button id="burger-btn" aria-label="Toggle menu" class="md:hidden flex flex-col gap-1.5">
        <span class="block w-6 h-0.5 bg-black"></span>
        <span class="block w-6 h-0.5 bg-black"></span>
        <span class="block w-6 h-0.5 bg-black"></span>
      </button>

      <nav id="header-menu" class="hidden md:flex w-2/4 gap-4 list-none h-fit">
        <?php
          if ( has_nav_menu( 'header-menu' ) ) {
            wp_nav_menu(array(
              'theme_location' => 'header-menu',
              'container'      => false,
              'items_wrap'     => '%3$s',
              'walker'         => new Testing_Task_Walker_Nav_Menu(),
            ));
          }
        ?>
      </nav>

      <?php if (get_option('testing_task_site_phone')) : ?>
        <a href='tel:<?php echo esc_attr(get_option('testing_task_site_phone')); ?>' class="hidden md:inline-block">
          <?php echo esc_html(get_option('testing_task_site_phone')); ?>
        </a>
      <?php endif; ?>
    </div>

    <nav id="mobile-menu" class="md:hidden overflow-hidden max-h-0 flex-col gap-4 py-0 border-t border-white/20 transition duration-700 transition-all">
      <?php
        if ( has_nav_menu( 'header-menu' ) ) {
          wp_nav_menu(array(
            'theme_location' => 'header-menu',
            'container'      => false,
            'items_wrap'     => '<ul class="flex flex-col gap-3">%3$s</ul>',
            'walker'         => new Testing_Task_Walker_Nav_Menu(),
          ));
        }
      ?>
      <?php if (get_option('testing_task_site_phone')) : ?>
        <a href='tel:<?php echo esc_attr(get_option('testing_task_site_phone')); ?>' class="block mt-4 text-lg font-semibold">
          <?php echo esc_html(get_option('testing_task_site_phone')); ?>
        </a>
      <?php endif; ?>
    </nav>
  </div>
</header>

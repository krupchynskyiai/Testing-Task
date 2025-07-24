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
	<header class='header'>
		<div class='container'>
			<div class='header__content flex justify-between gap-4'>
				<img class='' src='' alt='logo'>
				<div class='header__menu w-3/4'>
					<?php
            if ( has_nav_menu( 'header-menu' ) ) {
              wp_nav_menu( array(
                'theme_location' => 'heade-menu',
                'container'      => false,
                'menu_class'     => 'header__header-menu',
                'depth'          => 1,
            	));
        		}
        	?>
				</div>
			</div>
		</div>
	</header>

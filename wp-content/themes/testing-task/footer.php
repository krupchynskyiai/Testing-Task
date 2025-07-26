<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Testing_Task
 */

?>

<?php 
	$logo_id = get_option('testing_task_site_logo');
  $logo_url = $logo_id ? wp_get_attachment_url($logo_id) : ''; 
?>

	<footer class='footer border-t border-white-50 bg-sky-500/50'>
		<div class='container'>
			<div class='footer__content flex flex-row-reverse justify-between gap-24 md:justify-normal pt-8 pb-16 items-center'>
				<img src='<?php echo $logo_url ?>' class=' h-16' alt='footer-logo'>
				<div class='footer__menu w-fit flex flex-col gap-4'>
					<?php
            if ( has_nav_menu( 'footer-menu' ) ) {
              wp_nav_menu( array(
                'theme_location' => 'footer-menu',
                'container'      => false,
								'items_wrap'     => '%3$s',
								'walker'         => new Testing_Task_Walker_Nav_Menu(),
            	));
        		}
        	?>
				</div>
			</div>
		</div>
	</footer>
	<div class='copyright border-t border-white-50 bg-sky-500/30 p-2'>
		<div class='container'>
			<div class='copyright__content flex justify-between'>
				<p><?php echo get_option('testing_task_copyright') ?></p>
				<p>2020 - 2025</p>
			</div>
		</div>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

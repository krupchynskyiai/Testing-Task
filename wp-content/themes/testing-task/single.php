<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Testing_Task
 */

get_header(); ?>

<div class='main py-16 flex flex-col gap-8'>
<?php the_content(); ?>
</div>

<?php get_footer(); ?>

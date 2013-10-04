<?php
/*
Template Name: Sales Page Test
*/
//Display the header
get_header();
//Display the page content/body
if ( have_posts() ) while ( have_posts() )
{
the_post();
the_content();
}
//Display the footer
get_footer();
?>
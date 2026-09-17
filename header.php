<?php
use peaceful\donexa\Helper;
use peaceful\inc\class_site_layout\Theme_HBF_Manager;
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage donexa
 * @since 1.0
 * @version 1.0
 */

$sticky_header = '';
if (function_exists( 'get_field' ) && get_field('sticky_header') === 'yes') {
    // ACF has priority
  $sticky_header = 'pt-has-sticky';
} elseif (class_exists('Theme_header_customizer') && get_theme_mod('sticky_header_setting', 'yes') === 'yes') {
    // Fallback to theme mod if ACF is not yes
  $sticky_header = 'pt-has-sticky';
}
if (function_exists( 'get_field' ) && get_field('transparent_header') === 'yes') {
    // ACF has priority
  $transparent_header = 'transparent-header';
}
else
{
  $transparent_header = '';
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php   
    if ( ! function_exists( 'has_site_icon' ) || ! wp_site_icon() ) {
      if( !empty(get_theme_mod('favicon_image_setting')) ) { ?>
        <link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('favicon_image_setting')); ?>" />
        <?php 
      }
      else{
        ?>
        <link rel="shortcut icon" href="<?php echo CONST_DONEXA_ASSETS_URI.'img/favicon.png' ?>" />
      <?php }
    }
wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <!-- loading -->
  <?php donexa_display_loader(); ?>
  
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html__( 'Skip to content', 'donexa' ); ?></a>
 <?php 


    Theme_HBF_Manager::instance()->render_header( $sticky_header, $transparent_header );


//  banner_types_setting Start

    if ( ! is_singular( 'event_listing' ) ) {
        Theme_HBF_Manager::instance()->render_banner();
    }

// end

?> 
<div class="peacefulthemes-contain"> 
  <div class="site-content-contain">
    <div id="content" class="site-content">

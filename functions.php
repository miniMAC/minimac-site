<?php
/**
 * Theme functions - minimac-site
 * Enqueue Tailwind, SCSS compiled, JS on all pages
 * SEO optimized setup
 */

if (!defined('ABSPATH')) exit;

function minimac_site_setup() {
    // SEO & core support
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    // No Gutenberg blocks by default - classic theme
}
add_action('after_setup_theme', 'minimac_site_setup');

function minimac_site_scripts() {
    // Tailwind CSS compilato in locale
    wp_enqueue_style('tailwind-css', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '3.4.0');
    
    // Custom CSS dal tuo SCSS compilato (compila assets/scss/style.scss -> assets/css/custom.css)
    if (file_exists(get_template_directory() . '/assets/css/custom.css')) {
        wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css', array('tailwind-css'), filemtime(get_template_directory() . '/assets/css/custom.css'));
    }
    
    // JS script in tutte le pagine (footer)
    wp_enqueue_script('minimac-js', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'minimac_site_scripts');

// Rimuovi emoji e altri bloat per SEO/performance
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
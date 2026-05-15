<?php
/**
 * Theme functions - minimac-site
 * Enqueue Tailwind, SCSS compiled, JS on all pages + Opzioni Sito + Manutenzione
 * SEO optimized
 */

if (!defined('ABSPATH')) exit;

function minimac_site_setup() {
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 
        'caption', 'style', 'script'
    ));
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'minimac_site_setup');

// =============================================
// ENQUEUE STILI E SCRIPT
// =============================================
function minimac_site_scripts() {
    // Tailwind CSS (locale)
    wp_enqueue_style('tailwind-css', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '3.4.0');
    
    // Il tuo SCSS compilato (scss/style.css)
    if (file_exists(get_template_directory() . '/scss/style.css')) {
        wp_enqueue_style('custom-css', get_template_directory_uri() . '/scss/style.css', array('tailwind-css'), filemtime(get_template_directory() . '/scss/style.css'));
    } elseif (file_exists(get_template_directory() . '/assets/css/custom.css')) {
        wp_enqueue_style('custom-css', get_template_directory_uri() . '/assets/css/custom.css', array('tailwind-css'), filemtime(get_template_directory() . '/assets/css/custom.css'));
    }
    
    // JS su tutte le pagine
    wp_enqueue_script('minimac-js', get_template_directory_uri() . '/assets/js/script.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'minimac_site_scripts');

// Rimuovi bloat SEO
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// =============================================
// OPZIONI SITO + MANUTENZIONE
// =============================================
add_action('admin_menu', 'minimac_add_site_options_page');
function minimac_add_site_options_page() {
    add_options_page(
        'Opzioni Sito',
        'Opzioni Sito',
        'manage_options',
        'minimac-site-options',
        'minimac_site_options_page_html'
    );
}

add_action('admin_init', 'minimac_register_site_options');
function minimac_register_site_options() {
    register_setting('minimac_site_options', 'minimac_maintenance_mode');
}

function minimac_site_options_page_html() {
    ?>
    <div class="wrap">
        <h1>Opzioni Sito - minimac-site</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('minimac_site_options');
            do_settings_sections('minimac-site-options');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Modalità Manutenzione</th>
                    <td>
                        <label>
                            <input type="checkbox" name="minimac_maintenance_mode" value="1" 
                                <?php checked(1, get_option('minimac_maintenance_mode')); ?>>
                            Abilita modalità manutenzione (pagina bianca per utenti non loggati)
                        </label>
                        <p class="description">Solo gli utenti loggati potranno vedere il sito. Login sempre accessibile.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Modalità Manutenzione - Pagina bianca completa
add_action('template_redirect', 'minimac_maintenance_mode');
function minimac_maintenance_mode() {
    if (get_option('minimac_maintenance_mode') && !is_user_logged_in() && !is_admin()) {
        status_header(503);
        header('HTTP/1.1 503 Service Unavailable');
        header('Retry-After: 3600');

        echo '<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenzione in corso</title>
    <style>
        html, body { 
            margin:0; padding:0; height:100vh; background:#ffffff; 
            overflow:hidden; 
        }
    </style>
</head>
<body></body>
</html>';
        exit;
    }
}
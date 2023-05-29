<?php
/*
* Plugin Name: Countdown Master
* Plugin URI: https:codesystematic.om
* Author: Sajjad
* Author URI: https://sajjadcodes.com
* Description: Easy to add and display responsive Countdown timer on your website using shortcode.
* Text Domain: wp-countdown-master
* Domain Path: /languages/
* Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( ! defined( 'WPCT_VERSION' ) ) {
	define( 'WPCT_VERSION', '1.0.0' ); // Version of plugin
}

if(!defined('WPCT_PLUGIN_DIR')){
    define('WPCT_PLUGIN_DIR', plugin_dir_url( __FILE__) );
}

if(!function_exists('wpct_plugin_scripts')){
    function wpct_plugin_scripts(){
        wp_enqueue_style('wpct-css', WPCT_PLUGIN_DIR. 'assets/css/style.css' );
        wp_enqueue_script('wpct-js', WPCT_PLUGIN_DIR. 'assets/js/main.js', 'jQuery', '1.0.0', true);
    }
    add_action('wp_enqueue_scripts','wpct_plugin_scripts');
}

function enqueue_admin_styles() {
    wp_enqueue_style( 'plugin-admin-styles', plugin_dir_url( __FILE__ ) . 'admin/assets/css/mystyle.css' );
    wp_enqueue_script( 'plugin-admin-styles', plugin_dir_url( __FILE__ ) . 'admin/assets/js/myscript.js' );
}
add_action( 'admin_enqueue_scripts', 'enqueue_admin_styles' );

require plugin_dir_path( __FILE__ ). 'inc/settings.php';

function wpct_display_social_icons() {
    $social_icons = get_option('wpct_social_icons');
    $output = '';

    if (!empty($social_icons)) {
        $output .= '<ul class="wpct-social-icons">';
        
        foreach ($social_icons as $social => $url) {
            $icon_class = '';
        
            if ($social === 'facebook') {
                $icon_class = 'fab fa-facebook-f';
            } elseif ($social === 'twitter') {
                $icon_class = 'fab fa-twitter';
            } elseif ($social === 'instagram') {
                $icon_class = 'fab fa-instagram';
            }
            $output .= '<li><a href="' . esc_url($url) . '" target="_blank" class="wpct-social-icon wpct-social-' . esc_attr($social) . '"><i class="' . esc_attr($icon_class) . '"></i></a></li>';
        }        
        
        $output .= '</ul>';
    }

    return $output;
}

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

function wpct_countdown_shortcode($atts) {
    $atts = shortcode_atts(array(
        'format' => 'default'
    ), $atts);

    $alignment = get_option('wpct_alignment', 'left');
    $main_format = (array) get_option('wpct_main_format', array());
    // $secondary_format = (array) get_option('wpct_secondary_format', array());

//    $deadline = new DateTime($atts['format']);

    $format = isset($atts['format']) ? $atts['format'] : '';
    $deadline = new DateTime($format);

    $remaining = $deadline->diff(new DateTime());
    $days = $remaining->days;
    $hours = $remaining->h;
    $minutes = $remaining->i;
    $seconds = $remaining->s;

    $title = get_option('wpct_countdown_title_field_cp');
    $title_font_size = get_option('wpct_title_font_size', '16px');
    $title_color = get_option('wpct_title_color_callback', '#00BF96');
    $days_color = get_option('wpct_days_color', '#00816A');
    $days_bg_color = get_option('wpct_days_bg_color', '#00816A');

    $output = '<div id="clockdiv" style="text-align:' . $alignment . ';">';
    $output .= '<h1 style="color: ' . esc_attr($title_color) . '; font-size: ' . esc_attr($title_font_size) . ';">' . esc_html($title) . '</h1>';

    if (in_array('days', $main_format)) {
        $output .= '<div style = "background-color: ' . esc_attr($days_bg_color) . '">';
        $output .= '<span style = "background-color: ' . esc_attr($days_color) . ' ; " class="days"> ' . $days . '</span>';
        $output .= '<div class="smalltext">Days</div>';
        $output .= '</div>';
    }

    if (in_array('hours', $main_format)) {
        $output .= '<div style = "background-color: ' . esc_attr($days_bg_color) . '">';
        $output .= '<span style = "background-color: ' . esc_attr($days_color) . ' ; " class="hours"> ' . $hours . '</span>';
        $output .= '<div class="smalltext">Hours</div>';
        $output .= '</div>';
    }

    if (in_array('minutes', $main_format)) {
        $output .= '<div style = "background-color: ' . esc_attr($days_bg_color) . '">';
        $output .= '<span style = "background-color: ' . esc_attr($days_color) . ' ; " class="minutes"> ' . $minutes . '</span>';
        $output .= '<div class="smalltext">Minutes</div>';
        $output .= '</div>';
    }

    if (in_array('seconds', $main_format)) {
        $output .= '<div style = "background-color: ' . esc_attr($days_bg_color) . '">';
        $output .= '<span style = "background-color: ' . esc_attr($days_color) . ' ; " class="seconds"> ' . $seconds . '</span>';
        $output .= '<div class="smalltext">Seconds</div>';
        $output .= '</div>';
    }

    $output .= wpct_display_social_icons();

    $output .= '</div>';

    $output .= '<script>initializeClock("clockdiv", "' . $deadline->format('Y-m-d\TH:i:s') . '");</script>';

    return $output;
}
add_shortcode('wpct_countdown', 'wpct_countdown_shortcode');

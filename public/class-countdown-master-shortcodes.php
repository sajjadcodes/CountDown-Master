<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sajjadcodes.com
 * @since      1.0.0
 *
 * @package    Countdown_Master
 * @subpackage Countdown_Master/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Countdown_Master
 * @subpackage Countdown_Master/public
 * @author     Sajad <sajjadcodes@gmail.com>
 */
class Countdown_Master_Shortcodes {

	
	public function __construct(  ) {

        add_shortcode('wpct_countdown',[$this,'wpct_countdown_shortcode']);

	}

    public function wpct_display_social_icons() {
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

    public function wpct_countdown_shortcode($atts) {
   
            $atts = shortcode_atts(array(
                'format' => 'default'
            ), $atts);

            $alignment = get_option('wpct_alignment', 'left');
            $main_format = (array) get_option('wpct_main_format', array());

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

            $output .= $this->wpct_display_social_icons();

            $output .= '</div>';

            $output .= '<script>initializeClock("clockdiv", "' . $deadline->format('Y-m-d\TH:i:s') . '");</script>';

            return $output;
    }

}
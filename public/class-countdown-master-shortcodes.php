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
class Countdown_Master_Shortcodes
{


    public function __construct()
    {

        add_shortcode('wpct_countdown', [$this, 'wpct_countdown_shortcode']);
    }

    public function wpct_display_social_icons()
    {
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

    public function wpct_countdown_shortcode($atts)
    {

        $atts = shortcode_atts(array(
            'format' => 'default'
        ), $atts);

        $alignment = get_option('wpct_alignment', 'left');
        $main_format = (array) get_option('wpct_main_format', array());
        $labels_text = (array) get_option('wpct_labels_text', array());


        $format = isset($atts['format']) ? $atts['format'] : '';
        $deadline = new DateTime($format);

        $remaining = $deadline->diff(new DateTime());
        $days = $remaining->days;
        $hours = $remaining->h;
        $minutes = $remaining->i;
        $seconds = $remaining->s;

        $title = get_option('wpct_countdown_title_field_cp');
        $title_font_size = get_option('wpct_title_font_size', '40px');
        $title_color = get_option('wpct_title_color', '#00BF96');
        $title_weight = get_option('wpct_title_weight', '600');
        $title_line_height = get_option('wpct_title_line_height', '1.3');
        $number_font_size = get_option('wpct_number_font_size', '30px');
        $number_color = get_option('wpct_number_color', '#ffffff');
        $number_bg_color = get_option('wpct_number_bg_color', '#00BF96');
        $number_weight = get_option('wpct_number_weight', '600');
        $number_line_height = get_option('wpct_number_line_height', '1.3');
        $label_font_size = get_option('wpct_label_font_size', '14px');
        $label_color = get_option('wpct_label_color', '#ffffff');
        $label_weight = get_option('wpct_label_weight', '400');
        $label_line_height = get_option('wpct_label_line_height', '1.3');
        $label_bg_color = get_option('wpct_label_bg_color', '#008044');

        $image = get_option('image_upload');
        $image_url = wp_get_attachment_url($image);
        $image_thumb_url = wp_get_attachment_image_src($image, 'thumbnail');
        $output = '<div id="clockdiv" style="text-align:' . $alignment . ';">';
        if (!empty($image_url)) {
            $output .= '<img src="' . esc_attr($image_thumb_url[0]) . '" alt="Uploaded Image">';
        }
        $output .= '<h1 style="color: ' . esc_attr($title_color) . '; font-size: ' . esc_attr($title_font_size) . '; font-weight: ' . esc_attr($title_weight) . '; line-height: ' . esc_attr($title_line_height) . '; ">' . esc_html($title) . '</h1>';

        if (in_array('days', $main_format)) {
            $output .= '<div style = "background-color: ' . esc_attr($label_bg_color) . ' ;">';
            $output .= '<span style = "color: ' . esc_attr($number_color) . ' ; background-color: ' . esc_attr($number_bg_color) . ' ; font-size: ' . esc_attr($number_font_size) . ' ; font-weight: ' . esc_attr($number_weight) . ' ; line-height: ' . esc_attr($number_line_height) . ' ;" class="days"> ' . $days . '</span>';
            if (in_array('labels', $labels_text)) {
                $output .= '<div style="font-size: ' . esc_attr($label_font_size) . ' ; color: ' . esc_attr($label_color) . ' ; font-weight: ' . esc_attr($label_weight) . ' ; line-height: ' . esc_attr($label_line_height) . ' ;" class="smalltext">Days</div>';
            }
            $output .= '</div>';
        }

        if (in_array('hours', $main_format)) {
            $output .= '<div style = "background-color: ' . esc_attr($label_bg_color) . '">';
            $output .= '<span style = "color: ' . esc_attr($number_color) . ' ; background-color: ' . esc_attr($number_bg_color) . ' ; font-size: ' . esc_attr($number_font_size) . ' ; font-weight: ' . esc_attr($number_weight) . ' ; line-height: ' . esc_attr($number_line_height) . ' ;" class="hours"> ' . $hours . '</span>';
            if (in_array('labels', $labels_text)) {
                $output .= '<div style="font-size: ' . esc_attr($label_font_size) . ' ; color: ' . esc_attr($label_color) . ' ; font-weight: ' . esc_attr($label_weight) . ' ; line-height: ' . esc_attr($label_line_height) . ' ;" class="smalltext">Hours</div>';
            }
            $output .= '</div>';
        }

        if (in_array('minutes', $main_format)) {
            $output .= '<div style = "background-color: ' . esc_attr($label_bg_color) . '">';
            $output .= '<span style = "color: ' . esc_attr($number_color) . ' ; background-color: ' . esc_attr($number_bg_color) . ' ; font-size: ' . esc_attr($number_font_size) . ' ; font-weight: ' . esc_attr($number_weight) . ' ; line-height: ' . esc_attr($number_line_height) . ' ;" class="minutes"> ' . $minutes . '</span>';
            if (in_array('labels', $labels_text)) {
                $output .= '<div style="font-size: ' . esc_attr($label_font_size) . ' ; color: ' . esc_attr($label_color) . ' ; font-weight: ' . esc_attr($label_weight) . ' ; line-height: ' . esc_attr($label_line_height) . ' ;" class="smalltext">Minutes</div>';
            }
            $output .= '</div>';
        }

        if (in_array('seconds', $main_format)) {
            $output .= '<div style = "background-color: ' . esc_attr($label_bg_color) . '">';
            $output .= '<span style = "color: ' . esc_attr($number_color) . ' ; background-color: ' . esc_attr($number_bg_color) . ' ; font-size: ' . esc_attr($number_font_size) . ' ; font-weight: ' . esc_attr($number_weight) . ' ; line-height: ' . esc_attr($number_line_height) . ' ;" class="seconds"> ' . $seconds . '</span>';
            if (in_array('labels', $labels_text)) {
                $output .= '<div style="font-size: ' . esc_attr($label_font_size) . ' ; color: ' . esc_attr($label_color) . ' ; font-weight: ' . esc_attr($label_weight) . ' ; line-height: ' . esc_attr($label_line_height) . ' ;" class="smalltext">Seconds</div>';
            }
            $output .= '</div>';
        }

        $output .= $this->wpct_display_social_icons();

        $output .= '</div>';

        $output .= '<script>initializeClock("clockdiv", "' . $deadline->format('Y-m-d\TH:i:s') . '");</script>';

        return $output;
    }
}

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sajjadcodes.com
 * @since      1.0.0
 *
 * @package    Countdown_Master
 * @subpackage Countdown_Master/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Countdown_Master
 * @subpackage Countdown_Master/admin
 * @author     Sajad <sajjadcodes@gmail.com>
 */
class Countdown_Master_setting_Page {


    public function __construct(  ) {

	

	}

    public function wpct_plugin_settings_social_links() {
        add_settings_section('wpct_icons_section', '', [$this,'wpct_icons_section_callback'], 'wpct-settings-social-links');
        register_setting('wpct-settings-social-links', 'wpct_social_icons');
        add_settings_field('wpct_social_icons', 'Social Icons', [$this,'wpct_social_icons_field_callback'], 'wpct-settings-social-links', 'wpct_icons_section');
    }

    public function wpct_icons_section_callback() {
        echo '<p>This section allows you to configure the social icons for your plugin.</p>';
        echo '<p>Please enter the URLs for your social media profiles below:</p>';
    }


    public function wpct_social_icons_field_callback() {
        $social_icons = get_option('wpct_social_icons');
        ?>
        <input type="text" name="wpct_social_icons[facebook]" value="<?php echo isset($social_icons['facebook']) ? esc_attr($social_icons['facebook']) : ''; ?>" placeholder="Facebook URL">
        <input type="text" name="wpct_social_icons[twitter]" value="<?php echo isset($social_icons['twitter']) ? esc_attr($social_icons['twitter']) : ''; ?>" placeholder="Twitter URL">
        <input type="text" name="wpct_social_icons[instagram]" value="<?php echo isset($social_icons['instagram']) ? esc_attr($social_icons['instagram']) : ''; ?>" placeholder="Instagram URL">
        <?php
    }

    public function wpct_plugin_settings_customize(){
        add_settings_section('wpct_customize_section', '', '', 'wpct-settings-customize');
        register_setting('wpct-settings-customize', 'wpct_title_color_callback');
        register_setting('wpct-settings-customize', 'wpct_days_color');
        register_setting('wpct-settings-customize', 'wpct_days_bg_color');
        add_settings_field('wpct_title_color_field', 'Title Color', [$this,'wpct_title_color_callback'], 'wpct-settings-customize', 'wpct_customize_section');
        add_settings_field('wpct_days_color', 'Days Color', [$this,'wpct_days_color_callback'], 'wpct-settings-customize', 'wpct_customize_section');
        add_settings_field('wpct_days_bg_color', 'Countdown Background Color', [$this,'wpct_days_bg_color_callback'], 'wpct-settings-customize', 'wpct_customize_section');
    }

    public function wpct_plugin_settings() {
        add_settings_section('wpct_label_settings_section', 'Create a Master Countdown', '', 'wpct-settings');
        register_setting('wpct-settings', 'wpct_countdown_title_field_cp');
        register_setting('wpct-settings', 'wpct_title_font_size');
        register_setting('wpct-settings', 'wpct_alignment');
        register_setting('wpct-settings', 'wpct_main_format');
        add_settings_field('wpct_title_field', 'Countdown Title', [$this,'wpct_countdown_title_field_cp'], 'wpct-settings', 'wpct_label_settings_section');
        add_settings_field('wpct_title_font_size', 'Title Font Size', [$this,'wpct_title_font_size_callback'], 'wpct-settings', 'wpct_label_settings_section');
        add_settings_field('wpct_alignment_field', 'Alignment', [$this,'wpct_alignment_field_callback'], 'wpct-settings', 'wpct_label_settings_section');
        add_settings_field('wpct_main_format_field', 'Main Format', [$this,'wpct_formats_field_callback'], 'wpct-settings', 'wpct_label_settings_section');
    }

    public function wpct_countdown_title_field_cp(){
        // get the value of the setting we've registered with register_setting()
        $setting = get_option('wpct_countdown_title_field_cp');
        // output the field
        ?>
        <input type="text" name="wpct_countdown_title_field_cp" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
        <?php
    }

    public function wpct_title_font_size_callback() {
        $title_font_size = get_option('wpct_title_font_size', '16px');
        ?>
        <input type="text" name="wpct_title_font_size" value="<?php echo esc_attr($title_font_size); ?>">
        <?php
    }

    public function wpct_title_color_callback() {
        $title_color = get_option('wpct_title_color_callback', '#00BF96');
        ?>
        <input type="color" name="wpct_title_color_callback" value="<?php echo esc_attr($title_color); ?>">
        <?php
    }

    public function wpct_days_color_callback() {
        $days_color = get_option('wpct_days_color', '#00816A');
        ?>
        <input type="color" name="wpct_days_color" value="<?php echo esc_attr($days_color); ?>">
        <?php
    }
    
    public function wpct_days_bg_color_callback() {
        $days_bg_color = get_option('wpct_days_bg_color', '#00816A');
        ?>
        <input type="color" name="wpct_days_bg_color" value="<?php echo esc_attr($days_bg_color); ?>">
        <?php
    }

    public function wpct_alignment_field_callback() {
        $alignment = get_option('wpct_alignment', 'left');
    
        ?>
        <fieldset>
            <label><input type="radio" name="wpct_alignment" value="left" <?php checked('left', $alignment); ?>>Left</label>&nbsp
            <label><input type="radio" name="wpct_alignment" value="right" <?php checked('right', $alignment); ?>>Right</label>&nbsp
            <label><input type="radio" name="wpct_alignment" value="center" <?php checked('center', $alignment); ?>>Center</label>
        </fieldset>
        <?php
    }

    public function wpct_formats_field_callback() {
        $main_format = (array) get_option('wpct_main_format', array());
    
        ?>
        <fieldset>
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="days" <?php checked(in_array('days', $main_format), true); ?>>
                Days
            </label>&nbsp;
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="hours" <?php checked(in_array('hours', $main_format), true); ?>>
                Hours
            </label>&nbsp;
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="minutes" <?php checked(in_array('minutes', $main_format), true); ?>>
                Minutes
            </label>&nbsp;
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="seconds" <?php checked(in_array('seconds', $main_format), true); ?>>
                Seconds
            </label>
        </fieldset>
        <?php
    }

}




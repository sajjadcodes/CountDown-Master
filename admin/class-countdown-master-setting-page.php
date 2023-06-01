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
class Countdown_Master_setting_Page
{


    public function __construct()
    {
    }

    public function wpct_plugin_settings_social_links()
    {
        add_action('admin_post_wpct_save_image_upload', [$this, 'wpct_save_image_upload']);
        add_settings_section('wpct_icons_section', '', [$this, 'wpct_icons_section_callback'], 'wpct-settings-social-links');
        register_setting('wpct-settings-social-links', 'wpct_social_icons');
        add_settings_field('wpct_social_icons', 'Social Icons', [$this, 'wpct_social_icons_field_callback'], 'wpct-settings-social-links', 'wpct_icons_section');
    }

    public function wpct_plugin_settings_templates()
    {
        add_settings_section('wpct_templates_section', '', '', 'wpct-settings-templates');
        register_setting('wpct-settings-templates', 'wpct_images_gallery_templates');
        add_settings_field('wpct_templates_field', 'Templates', [$this, 'wpct_templates_gallery_field'], 'wpct-settings-templates', 'wpct_templates_section');
    }

    public function wpct_image_settings_callback()
    {
        add_settings_section('wpct_image_section', '', '', 'wpct-image-settings');
        register_setting('wpct-image-settings', 'image_upload');
        add_settings_field('wpct_image_field', 'Add Image', [$this, 'wpct_image_field_cp'], 'wpct-image-settings', 'wpct_image_section');
    }

    public function wpct_icons_section_callback()
    {
        echo '<p>This section allows you to configure the social icons for your plugin.</p>';
        echo '<p>Please enter the URLs for your social media profiles below:</p>';
    }


    public function wpct_social_icons_field_callback()
    {
        $social_icons = get_option('wpct_social_icons');
?>
        <input type="text" name="wpct_social_icons[facebook]" value="<?php echo isset($social_icons['facebook']) ? esc_attr($social_icons['facebook']) : ''; ?>" placeholder="Facebook URL">
        <input type="text" name="wpct_social_icons[twitter]" value="<?php echo isset($social_icons['twitter']) ? esc_attr($social_icons['twitter']) : ''; ?>" placeholder="Twitter URL">
        <input type="text" name="wpct_social_icons[instagram]" value="<?php echo isset($social_icons['instagram']) ? esc_attr($social_icons['instagram']) : ''; ?>" placeholder="Instagram URL">
    <?php
    }

    public function wpct_plugin_settings_customize()
    {
        add_settings_section('wpct_customize_section', '', '', 'wpct-settings-customize');
        register_setting('wpct-settings-customize', 'wpct_title_font_size');
        register_setting('wpct-settings-customize', 'wpct_title_color');
        register_setting('wpct-settings-customize', 'wpct_title_weight');
        register_setting('wpct-settings-customize', 'wpct_title_line_height');
        register_setting('wpct-settings-customize', 'wpct_number_font_size');
        register_setting('wpct-settings-customize', 'wpct_number_color');
        register_setting('wpct-settings-customize', 'wpct_number_bg_color');
        register_setting('wpct-settings-customize', 'wpct_number_weight');
        register_setting('wpct-settings-customize', 'wpct_number_line_height');
        register_setting('wpct-settings-customize', 'wpct_label_font_size');
        register_setting('wpct-settings-customize', 'wpct_label_color');
        register_setting('wpct-settings-customize', 'wpct_label_weight');
        register_setting('wpct-settings-customize', 'wpct_label_line_height');
        register_setting('wpct-settings-customize', 'wpct_label_bg_color');
        add_settings_field('wpct_title_restore', 'Title Setting', [$this, 'wpct_title_font_size_callback'], 'wpct-settings-customize', 'wpct_customize_section');
        add_settings_field('wpct_number_font_size', 'Number Setting', [$this, 'wpct_numbers_setting'], 'wpct-settings-customize', 'wpct_customize_section');
        add_settings_field('wpct_label_font_size', 'Label Setting', [$this, 'wpct_label_setting'], 'wpct-settings-customize', 'wpct_customize_section');
        add_settings_field('wpct_restore_defaults', 'Restore Defaults', [$this, 'wpct_restore_defaults_callback'], 'wpct-settings-customize', 'wpct_customize_section');
    }

    public function wpct_plugin_settings()
    {
        add_settings_section('wpct_label_settings_section', 'Create a Master Countdown', [$this, 'wpct_plugin_shortcode_details'], 'wpct-settings');
        register_setting('wpct-settings', 'wpct_countdown_title_field_cp');
        register_setting('wpct-settings', 'wpct_alignment');
        register_setting('wpct-settings', 'wpct_main_format');
        register_setting('wpct-settings', 'wpct_labels_text');
        add_settings_field('wpct_title_field', 'Countdown Title', [$this, 'wpct_countdown_title_field_cp'], 'wpct-settings', 'wpct_label_settings_section');
        add_settings_field('wpct_alignment_field', 'Alignment', [$this, 'wpct_alignment_field_callback'], 'wpct-settings', 'wpct_label_settings_section');
        add_settings_field('wpct_main_format_field', 'Main Format', [$this, 'wpct_formats_field_callback'], 'wpct-settings', 'wpct_label_settings_section');
        add_settings_field('wpct_label_text_field', 'Display Time Label Text', [$this, 'wpct_labels_field_callback'], 'wpct-settings', 'wpct_label_settings_section');
    }

    public function wpct_plugin_shortcode_details()
    {
        echo '<p>To Display a Countdown on any place on the website Use Shortcode using the Below Format</p>';
        echo '<p>[wpct_countdown format="2023-07-10"]</p>';
    }

    public function wpct_countdown_title_field_cp()
    {
        // get the value of the setting we've registered with register_setting()
        $setting = get_option('wpct_countdown_title_field_cp');
    ?>
        <input type="text" name="wpct_countdown_title_field_cp" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>">
    <?php
    }

    public function wpct_image_field_cp()
    {

        $image = get_option('image_upload');
        $image_thumb_url = wp_get_attachment_image_src($image, 'thumbnail');
    ?>
        <label for="image_upload">Upload an Image:</label>
        <input type="file" id="image_upload" name="image_upload">
        <br>
        <br>
        <?php if (!empty($image_thumb_url)) : ?>
            <img src="<?php echo esc_attr($image_thumb_url[0]); ?>" alt="Uploaded Image">
            <input type="hidden" name="image_upload_url" value="<?php echo esc_attr($image); ?>">
        <?php endif; ?>
    <?php
    }

    function wpct_save_image_upload()
    {
        if (!empty($_FILES['image_upload']['tmp_name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            $uploadedfile = $_FILES['image_upload'];
            $upload_overrides = array('test_form' => false);
            $attachment_id = media_handle_upload('image_upload', 0, array(), $upload_overrides);

            if (!is_wp_error($attachment_id)) {
                update_option('image_upload', $attachment_id);
            }

            wp_redirect(admin_url('admin.php?page=wpct-settings'));
            exit;
        }
    }


    public function wpct_templates_gallery_field()
    {
        $templates_gallery = get_option('wpct_images_gallery_templates');
        $image_thumb_url = wp_get_attachment_image_src($templates_gallery, 'thumbnail');

        // Retrieve the list of available templates (image URLs or attachment IDs)
        $templates = array(
            'template1' => plugin_dir_url(__FILE__) . '../assets/img/micro.jpg',
            'template2' => plugin_dir_url(__FILE__) . '../assets/img/micro2.jpg',
            // Add more templates as needed
        );
    ?>
        <div class="wpct-gallery">
            <?php foreach ($templates as $template_id => $template_url) : ?>
                <label>
                    <input type="radio" name="wpct_images_gallery_templates" value="<?php echo esc_attr($template_id); ?>" <?php checked($templates_gallery, $template_id); ?>>
                    <img src="<?php echo esc_url($template_url); ?>" class="temp_imgs" alt="<?php echo esc_attr($template_id); ?>">
                </label>
            <?php endforeach; ?>
        </div>
    <?php
    }


    public function wpct_title_font_size_callback()
    {
        $title_font_size = get_option('wpct_title_font_size', '40px');
        $title_color = get_option('wpct_title_color', '#00BF96');
        $title_weight = get_option('wpct_title_weight', '600');
        $title_line_height = get_option('wpct_title_line_height', '1.3');
    ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="wpct_title_font_size"><?php esc_html_e('Font Size', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_title_font_size" value="<?php echo esc_attr($title_font_size); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_title_color"><?php esc_html_e('Color', 'text-domain') ?></label></th>
                <td><input type="color" name="wpct_title_color" value="<?php echo esc_attr($title_color); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_title_weight"><?php esc_html_e('Font Weight', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_title_weight" value="<?php echo esc_attr($title_weight); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_title_line_height"><?php esc_html_e('Line Height', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_title_line_height" value="<?php echo esc_attr($title_line_height); ?>"></td>
            </tr>
        </table>
    <?php
    }

    public function wpct_numbers_setting()
    {
        $number_font_size = get_option('wpct_number_font_size', '30px');
        $number_color = get_option('wpct_number_color', '#ffffff');
        $number_bg_color = get_option('wpct_number_bg_color', '#00BF96');
        $number_weight = get_option('wpct_number_weight', '600');
        $number_line_height = get_option('wpct_number_line_height', '1.3');
    ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="wpct_number_font_size"><?php esc_html_e('Font Size', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_number_font_size" value="<?php echo esc_attr($number_font_size); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_number_color"><?php esc_html_e('Color', 'text-domain') ?></label></th>
                <td><input type="color" name="wpct_number_color" value="<?php echo esc_attr($number_color); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_number_bg_color"><?php esc_html_e('Background Color', 'text-domain') ?></label></th>
                <td><input type="color" name="wpct_number_bg_color" value="<?php echo esc_attr($number_bg_color); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_number_weight"><?php esc_html_e('Font Weight', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_number_weight" value="<?php echo esc_attr($number_weight); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_number_line_height"><?php esc_html_e('Line Height', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_number_line_height" value="<?php echo esc_attr($number_line_height); ?>"></td>
            </tr>
        </table>
    <?php
    }

    public function wpct_label_setting()
    {
        $label_font_size = get_option('wpct_label_font_size', '14px');
        $label_color = get_option('wpct_label_color', '#ffffff');
        $label_weight = get_option('wpct_label_weight', '400');
        $label_line_height = get_option('wpct_label_line_height', '1.3');
        $label_bg_color = get_option('wpct_label_bg_color', '#008044');
    ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="wpct_label_font_size"><?php esc_html_e('Font Size', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_label_font_size" value="<?php echo esc_attr($label_font_size); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_label_color"><?php esc_html_e('Color', 'text-domain') ?></label></th>
                <td><input type="color" name="wpct_label_color" value="<?php echo esc_attr($label_color); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_label_weight"><?php esc_html_e('Font Weight', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_label_weight" value="<?php echo esc_attr($label_weight); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_label_line_height"><?php esc_html_e('Line Height', 'text-domain') ?></label></th>
                <td><input type="text" name="wpct_label_line_height" value="<?php echo esc_attr($label_line_height); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="wpct_label_bg_color"><?php esc_html_e('Background Color', 'text-domain') ?></label></th>
                <td><input type="color" name="wpct_label_bg_color" value="<?php echo esc_attr($label_bg_color); ?>"></td>
            </tr>
        </table>
    <?php
    }

    public function wpct_restore_defaults_callback()
    {
    ?>
        <button type="button" class="button" id="wpct-restore-defaults">Restore Defaults</button>
    <?php
    }

    public function wpct_alignment_field_callback()
    {
        $alignment = get_option('wpct_alignment', 'left');

    ?>
        <fieldset>
            <label><input type="radio" name="wpct_alignment" value="left" <?php checked('left', $alignment); ?>><?php esc_html_e('Left', 'text-domain') ?></label>&nbsp
            <label><input type="radio" name="wpct_alignment" value="right" <?php checked('right', $alignment); ?>><?php esc_html_e('Right', 'text-domain') ?></label>&nbsp
            <label><input type="radio" name="wpct_alignment" value="center" <?php checked('center', $alignment); ?>><?php esc_html_e('Center', 'text-domain') ?></label>
        </fieldset>
    <?php
    }

    public function wpct_formats_field_callback()
    {
        $main_format = (array) get_option('wpct_main_format', array());

    ?>
        <fieldset>
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="days" <?php checked(in_array('days', $main_format), true); ?>><?php esc_html_e('Days', 'text-domain') ?>
            </label>&nbsp;
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="hours" <?php checked(in_array('hours', $main_format), true); ?>><?php esc_html_e('Hours', 'text-domain') ?>
            </label>&nbsp;
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="minutes" <?php checked(in_array('minutes', $main_format), true); ?>><?php esc_html_e('Minutes', 'text-domain') ?>
            </label>&nbsp;
            <label>
                <input type="checkbox" name="wpct_main_format[]" value="seconds" <?php checked(in_array('seconds', $main_format), true); ?>><?php esc_html_e('Seconds', 'text-domain') ?>
            </label>
        </fieldset>
    <?php
    }

    public function wpct_labels_field_callback()
    {
        $labels_text = (array) get_option('wpct_labels_text', array());

    ?>
        <fieldset>
            <label>
                <input type="checkbox" name="wpct_labels_text[]" value="labels" <?php checked(in_array('labels', $labels_text), true); ?>><?php esc_html_e('', 'text-domain') ?>
            </label>
        </fieldset>
<?php
    }
}

// $settingPage = new Countdown_Master_setting_Page();
// $settingPage->wpct_save_image_upload();

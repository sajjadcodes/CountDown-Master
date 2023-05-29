<?php

function wpct_settings_page_html(){
    if(!is_admin()){
        return;
    }
    ?>
        <div class="wrap">
            <h1 style="color: #111111"><?php echo esc_html(get_admin_page_title()); ?></h1>
            <?php settings_errors(); ?>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1">General Settings</a></li>
                <li><a href="#tab-2">Customize</a></li>
                <li><a href="#tab-3">Social Links</a></li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <form action="options.php" method="post">
                    <?php
                        settings_fields('wpct-settings');
                        do_settings_sections('wpct-settings');
                        submit_button('Save Changes');
                    ?>
                    </form>
                </div>
                <div id="tab-2" class="tab-pane">
                    <h3>Customize</h3>
                    <form action="options.php" method="post">
                    <?php
                        settings_fields('wpct-settings-customize');
                        do_settings_sections('wpct-settings-customize');
                        submit_button('Save Changes');
                    ?>
                    </form>
                </div>
                <div id="tab-3" class="tab-pane">
                    <h3>Social Links</h3>
                    <form action="options.php" method="post">
                    <?php
                        settings_fields('wpct-settings-social-links');
                        do_settings_sections('wpct-settings-social-links');
                        submit_button('Save Changes');
                    ?>
                    </form>  
                </div>
            </div>
        </div>
    <?php
}

function wpct_register_menu_page(){

    add_menu_page('Countdown Master', 'Countdown Master','manage_options','wpct-settings', 'wpct_settings_page_html','dashicons-clock', 30);
}
add_action('admin_menu','wpct_register_menu_page');

function wpct_plugin_settings_social_links() {
    add_settings_section('wpct_icons_section', '', 'wpct_icons_section_callback', 'wpct-settings-social-links');
    register_setting('wpct-settings-social-links', 'wpct_social_icons');
    add_settings_field('wpct_social_icons', 'Social Icons', 'wpct_social_icons_field_callback', 'wpct-settings-social-links', 'wpct_icons_section');
}
add_action('admin_init', 'wpct_plugin_settings_social_links');

function wpct_icons_section_callback() {
    echo '<p>This section allows you to configure the social icons for your plugin.</p>';
    echo '<p>Please enter the URLs for your social media profiles below:</p>';
}


function wpct_social_icons_field_callback() {
    $social_icons = get_option('wpct_social_icons');
    ?>
    <input type="text" name="wpct_social_icons[facebook]" value="<?php echo isset($social_icons['facebook']) ? esc_attr($social_icons['facebook']) : ''; ?>" placeholder="Facebook URL">
    <input type="text" name="wpct_social_icons[twitter]" value="<?php echo isset($social_icons['twitter']) ? esc_attr($social_icons['twitter']) : ''; ?>" placeholder="Twitter URL">
    <input type="text" name="wpct_social_icons[instagram]" value="<?php echo isset($social_icons['instagram']) ? esc_attr($social_icons['instagram']) : ''; ?>" placeholder="Instagram URL">
    <?php
}


function wpct_plugin_settings_customize(){
    add_settings_section('wpct_customize_section', '', '', 'wpct-settings-customize');
    register_setting('wpct-settings-customize', 'wpct_title_color_callback');
    register_setting('wpct-settings-customize', 'wpct_days_color');
    register_setting('wpct-settings-customize', 'wpct_days_bg_color');
    add_settings_field('wpct_title_color_field', 'Title Color', 'wpct_title_color_callback', 'wpct-settings-customize', 'wpct_customize_section');
    add_settings_field('wpct_days_color', 'Days Color', 'wpct_days_color_callback', 'wpct-settings-customize', 'wpct_customize_section');
    add_settings_field('wpct_days_bg_color', 'Countdown Background Color', 'wpct_days_bg_color_callback', 'wpct-settings-customize', 'wpct_customize_section');
}
add_action('admin_init', 'wpct_plugin_settings_customize');

function wpct_plugin_settings() {
    add_settings_section('wpct_label_settings_section', 'Create a Master Countdown', '', 'wpct-settings');
    register_setting('wpct-settings', 'wpct_countdown_title_field_cp');
    register_setting('wpct-settings', 'wpct_title_font_size');
    register_setting('wpct-settings', 'wpct_alignment');
    register_setting('wpct-settings', 'wpct_main_format');
    add_settings_field('wpct_title_field', 'Countdown Title', 'wpct_countdown_title_field_cp', 'wpct-settings', 'wpct_label_settings_section');
    add_settings_field('wpct_title_font_size', 'Title Font Size', 'wpct_title_font_size_callback', 'wpct-settings', 'wpct_label_settings_section');
    add_settings_field('wpct_alignment_field', 'Alignment', 'wpct_alignment_field_callback', 'wpct-settings', 'wpct_label_settings_section');
    add_settings_field('wpct_main_format_field', 'Main Format', 'wpct_formats_field_callback', 'wpct-settings', 'wpct_label_settings_section');
}

add_action('admin_init', 'wpct_plugin_settings');

function wpct_countdown_title_field_cp(){
    // get the value of the setting we've registered with register_setting()
	$setting = get_option('wpct_countdown_title_field_cp');
	// output the field
	?>
	<input type="text" name="wpct_countdown_title_field_cp" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

function wpct_title_font_size_callback() {
    $title_font_size = get_option('wpct_title_font_size', '16px');
    ?>
    <input type="text" name="wpct_title_font_size" value="<?php echo esc_attr($title_font_size); ?>">
    <?php
}

function wpct_title_color_callback() {
    $title_color = get_option('wpct_title_color_callback', '#00BF96');
    ?>
    <input type="color" name="wpct_title_color_callback" value="<?php echo esc_attr($title_color); ?>">
    <?php
}

function wpct_days_color_callback() {
    $days_color = get_option('wpct_days_color', '#00816A');
    ?>
    <input type="color" name="wpct_days_color" value="<?php echo esc_attr($days_color); ?>">
    <?php
}

function wpct_days_bg_color_callback() {
    $days_bg_color = get_option('wpct_days_bg_color', '#00816A');
    ?>
    <input type="color" name="wpct_days_bg_color" value="<?php echo esc_attr($days_bg_color); ?>">
    <?php
}

function wpct_alignment_field_callback() {
    $alignment = get_option('wpct_alignment', 'left');

    ?>
    <fieldset>
        <label><input type="radio" name="wpct_alignment" value="left" <?php checked('left', $alignment); ?>>Left</label>&nbsp
        <label><input type="radio" name="wpct_alignment" value="right" <?php checked('right', $alignment); ?>>Right</label>&nbsp
        <label><input type="radio" name="wpct_alignment" value="center" <?php checked('center', $alignment); ?>>Center</label>
    </fieldset>
    <?php
}

function wpct_formats_field_callback() {
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
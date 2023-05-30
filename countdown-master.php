<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sajjadcodes.com
 * @since             1.0.0
 * @package           Countdown_Master
 *
 * @wordpress-plugin
 * Plugin Name:       Countdown Master
 * Plugin URI:        https://sajjadcodes.com/plugins/countdown-master
 * Description:       Easy to use WordPress countdown plugin with pro features
 * Version:           1.0.0
 * Author:            Sajad
 * Author URI:        https://sajjadcodes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       countdown-master
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'COUNTDOWN_MASTER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-countdown-master-activator.php
 */
function activate_countdown_master() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-countdown-master-activator.php';
	Countdown_Master_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-countdown-master-deactivator.php
 */
function deactivate_countdown_master() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-countdown-master-deactivator.php';
	Countdown_Master_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_countdown_master' );
register_deactivation_hook( __FILE__, 'deactivate_countdown_master' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-countdown-master.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_countdown_master() {

	$plugin = new Countdown_Master();
	$plugin->run();

}
run_countdown_master();

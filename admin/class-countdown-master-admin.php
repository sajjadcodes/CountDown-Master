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
class Countdown_Master_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Countdown_Master_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Countdown_Master_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/countdown-master-admin.css', array(), $this->version, 'all');
		wp_enqueue_style('jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
		wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Roboto:300,400,500,700|Raleway:300,400,500,700|Montserrat:300,400,500,700&display=swap');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Countdown_Master_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Countdown_Master_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/countdown-master-admin.js', array('jquery'), $this->version, false);
		wp_enqueue_script('jquery-ui-core', false, array('jquery'));
		wp_enqueue_script('jquery-ui-datepicker', false, array('jquery'));
	}
}

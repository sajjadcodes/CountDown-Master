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
class Countdown_Master_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/countdown-1.css', array(), $this->version, 'all');
		wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
		wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Lato:300,400,600,700|Roboto:300,400,500,700|Raleway:300,400,500,700|Montserrat:300,400,500,700&display=swap');
		$templates = get_option('wpct_templates', '');
		if ($templates === '../countdown-2.php') {
			wp_enqueue_style('countdown-2', plugin_dir_url(__FILE__) . 'css/countdown-2.css');
		}
	}

	/**
	 * Register the JavaScript for the public-facing 0side of the site.
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
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/countdown-1.js', array('jquery'), $this->version, false);
		$templates = get_option('wpct_templates', '');
		if ($templates === '../countdown-2.php') {
			wp_enqueue_script('countdown-2-script', plugin_dir_url(__FILE__) . 'js/countdown-2.js', array('jquery'), '1.0', true);
			wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '2.1.3', true);
			wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js', array(), '3.9.1', true);
		}
	}
}

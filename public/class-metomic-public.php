<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://metomic.io
 * @since      1.0.0
 *
 * @package    Metomic
 * @subpackage Metomic/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Metomic
 * @subpackage Metomic/public
 * @author     Anosh Malik <anosh@metomic.io>
 */
class Metomic_Public {

	const EMBED_URL = "https://consent-manager.metomic.io/embed.js";

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $metomic    The ID of this plugin.
	 */
	private $metomic;

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
	 * @param      string    $metomic       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $metomic, $version ) {

		$this->metomic = $metomic;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Metomic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Metomic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$projectId = trim(get_option('mtm_project_id', ''));
		$domain = site_url();

		if (empty($projectId)) {

			wp_enqueue_script($this->metomic, self::EMBED_URL, [], $this->version, true);
			wp_script_add_data($this->metomic, 'onload', "window.Metomic('load', { domain: '$domain', language: 'auto' });");

		} else {

			$configUrl = "https://config.metomic.io/config.js?id=$projectId";
			$configContents = file_get_contents($configUrl);
			$matches = [];
			preg_match('/("autoblockingEnabled": true)/', $configContents, $matches);
			$autoblockingEnabled = count($matches);
			wp_enqueue_script($this->metomic, self::EMBED_URL, [], $this->version, !$autoblockingEnabled);
			if ($autoblockingEnabled) {
				wp_add_inline_script($this->metomic, $configContents, 'before');
			} else {
				wp_script_add_data($this->metomic, 'onload', "window.Metomic('load', { projectId: '$projectId' });");
			}
		}
	}

	public function script_filter($tag, $handle) {
		if ($handle !== $this->metomic) return $tag;

		$onLoad = wp_scripts()->get_data( $handle,'onload');
		if ($onLoad) {
			$tag = str_replace('<script ', '<script onload="javascript:' . $onLoad . '" defer ', $tag);
		}
		return $tag;
	}
}

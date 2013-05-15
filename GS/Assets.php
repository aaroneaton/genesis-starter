<?php

class GS_Assets {

	private static $instance;

	public function __construct() {

		self::$instance = $this;

		// add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		// add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'register_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

	}

	public function register_scripts() {
		// We are registering Modernizr separately
		wp_register_script(
			'gs_modernizer',
			'//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js',
			array(),
			false,
			false
		);

		// Register the foundation scripts
		wp_register_script(
			'gs_app',
			get_stylesheet_directory_uri() . '/js/scripts.js',
			array( 'jquery' ),
			false,
			true
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'gs_modernizer' );
		wp_enqueue_script( 'gs_app' );
	}

	public function register_styles() {
		// Only register the style.css created by Stylus
		wp_register_style(
			'gs_stylesheet',
			get_stylesheet_directory_uri() . '/css/screen.css',
			array(),
			'',
			'screen'
		);
	}

	public function enqueue_styles() {
		wp_enqueue_style( 'gs_stylesheet' );
	}

	public static function get_instance() {
		return self::$instance;
	}

}
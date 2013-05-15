<?php

/** Start the engine **/
require_once( TEMPLATEPATH . '/lib/init.php');

define( 'GS_THEME_DIRNAME', 'gen-start' );
define( 'GS_THEME_DIRPATH', plugin_dir_path( __FILE__ ) );
define( 'GS_THEME_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'GS_META_PREFIX', '_gs_' );

// Autoload all classes
spl_autoload_register( 'GenStart::autoload' );

class GenStart {

	public $version = '1.0';

	private static $file = __FILE__;

	public function __construct() {

		// Load up the plugin
		add_action( 'init', array( $this, 'init' ) );

	}

	public function init() {

		//Initialize the theme classes
		$gs_cleanup = new GS_Cleanup;
		$gs_assets = new GS_Assets;

		// Setup the navigation
		$gs_navigation = new GS_Navigation;

	}

	public static function autoload( $classname ) {

		$filename = dirname( __FILE__ ) .
      DIRECTORY_SEPARATOR .
      str_replace( '_', DIRECTORY_SEPARATOR, $classname ) .
      '.php';
    if ( file_exists( $filename ) )
      require $filename;

	}

}

new GenStart;
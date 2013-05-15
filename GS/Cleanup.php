<?php

class GS_Cleanup {

	private static $instance;

	public function __construct() {

		self::$instance = $this;

		$this->remove_stylesheet();
		$this->remove_secondary_nav();
		$this->remove_edit_link();
		$this->remove_post_info();
		$this->remove_post_meta();
		add_action( 'admin_init', array( $this, 'remove_profile_fields' ) );
		$this->remove_genesis_layouts();
		$this->remove_genesis_sidebars();

	}

	private function remove_stylesheet() {
		remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	}

	private function remove_secondary_nav() {
		add_theme_support(
			'genesis-menus',
			array( 'primary' => 'Primary Navigation Menu' )
		);
	}

	private function remove_edit_link() {
		add_filter( 'genesis_edit_post_link', '__return_false' );
	}

	private function remove_post_info() {
		remove_action( 'genesis_before_post_content', 'genesis_post_info' );
	}

	private function remove_post_meta() {
		remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
	}

	/**
	 * Remove these fields by default
	 *
	 * @return void
	 */
	public function remove_profile_fields() {
		remove_action( 'show_user_profile', 'genesis_user_options_fields' );
		remove_action( 'edit_user_profile', 'genesis_user_options_fields' );
		remove_action( 'show_user_profile', 'genesis_user_archive_fields' );
		remove_action( 'edit_user_profile', 'genesis_user_archive_fields' );
		remove_action( 'show_user_profile', 'genesis_user_seo_fields'     );
		remove_action( 'edit_user_profile', 'genesis_user_seo_fields'     );
		remove_action( 'show_user_profile', 'genesis_user_layout_fields'  );
		remove_action( 'edit_user_profile', 'genesis_user_layout_fields'  );
	}

	/**
	 * Genesis layouts don't work with Foundation. Get rid of them!
	 *
	 * @return void
	 */
	private function remove_genesis_layouts() {
		// genesis_unregister_layout( 'sidebar-content'         );
		// genesis_unregister_layout( 'content-sidebar-sidebar' );
		// genesis_unregister_layout( 'sidebar-sidebar-content' );
		// genesis_unregister_layout( 'sidebar-content-sidebar' );
		// genesis_unregister_layout( 'content-sidebar'      );
		// genesis_unregister_layout( 'full-width-content'   );
	}

	private function remove_genesis_sidebars() {
		unregister_sidebar( 'sidebar-alt' );
		unregister_sidebar( 'header-right' );
	}


}

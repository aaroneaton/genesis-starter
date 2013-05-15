<?php

class GS_Navigation {

	private static $instance;

	public function __construct() {

		self::$instance = $this;

		add_action( 'genesis_after_header', array( $this, 'mobile_menu_button' ), 2 );
		add_action( 'genesis_before_footer', array( $this, 'mobile_menu_footer') );

	}

	public function mobile_menu_button() {

		$html = '<div id="mobile-menu-button">';
		$html .= '<a href="#mobile-menu">Menu</a>';
		$html .= '</div>';

		echo $html;

	}

	public function mobile_menu_footer() {

		$args = array(
			'theme_location' => 'primary',
			'container' => '',
			'menu-class' => 'menu genesis-nav-menu menu-primary',
			'echo' => 1,
			'items_wrap' => '<ul><li class="menu-item"><a href="/">Home</a></li>%3$s</ul>',
		);

		echo '<a class="anchor" name="mobile-menu">';
		echo '<div id="mobile-menu-footer">';
		wp_nav_menu( $args );
		echo '</div>';

	}

	public static function get_instance() {

		return self::$instance;

	}

}
<?php
/*
Plugin Name: Dev Support
Description: This plugin includes all the code that help you decorate the site. It's the necessary plugin from your webmaster. If you deactivate or remove this plugin you may lose your customization.
Plugin URI: http://www.themesplugin.com/
Author: Sharojit
Author URI: http://www.sharojit.com/
Version: 1.0
License: GPL2
*/

//create a widget area
function stp_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Content', 'stp' ),
		'id' => 'stp-content',
		'description' => __( 'This is a the siderbar area your can use in your content area. Using [stpbar name="stp-content"] shortcode', 'stp' ),
		'before_widget' => '<aside id="stp-content-widget" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'stp_widgets_init' );

//Add sidebar to your content using shortcode [stpbar name="Your Widget Name"]
function stp_widget($atts, $content=null){
	extract(shortcode_atts(array('name' => ''), $atts));

	if (is_active_sidebar($name)){
		ob_start();
    	dynamic_sidebar($name);
    	$widgets= ob_get_contents();
    	ob_end_clean();

    	return $widgets;
	}else{
		return "";
	}
}
add_shortcode('stpbar','stp_widget');

//Add menu to your content using shortcode [stpmenu name="Your menu Name"]
function stp_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, ), $atts));
	$stp = '<aside id="stp-content-widget">';
	$stp .= wp_nav_menu( array( 'menu' => $name, 'echo' => false ) );
	$stp .= '</aside>';
    return $stp;
}
add_shortcode('stpmenu', 'stp_menu_shortcode');

?>

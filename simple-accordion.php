<?php 
/*
Plugin Name: MAM Simple Accordion
Plugin URI: http://mamunkhan.net/plugins/mam-simple-accordion/
Description: This plugin will enable mam-simple-accordion your wordpress theme. You can embed mam-simple-accordion via shortcode in everywhere you want, even in theme files. 
Author: MAMUN KHAN
Version: 1.0
Author URI: http://mamunkhan.net
*/







/*Some Set-up*/
define('MAM_SIMPLTE_ACCORDION_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


/* Adding Latest jQuery from Wordpress */
function simple_accordion_wp_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'simple_accordion_wp_latest_jquery');

/* Adding plugin javascript Main file */
wp_enqueue_script('mam-accordion-plugin-main', MAM_SIMPLTE_ACCORDION_PLUGIN_PATH.'js/jquery.collapse.js', array('jquery'));

/* Adding plugin javascript active file */
wp_enqueue_script('mam-accordion-plugin-script-active', MAM_SIMPLTE_ACCORDION_PLUGIN_PATH.'js/mam-accordion.js', array('jquery'), '1.0', true);

/* Adding Plugin custm CSS file */
wp_enqueue_style('mam-extra-accordion-plugin-style', MAM_SIMPLTE_ACCORDION_PLUGIN_PATH.'css/mam-accordion.css');
wp_enqueue_style('mam-responsive-accordion-plugin-style', MAM_SIMPLTE_ACCORDION_PLUGIN_PATH.'css/responsive.css');





/* Add Slider Shortcode Button on Post Visual Editor */

function ppmaccordion_button() {
	add_filter ("mce_external_plugins", "ppmaccordion_button_js");
	add_filter ("mce_buttons", "ppmaccordionb");
}

function ppmaccordion_button_js($plugin_array) {
	$plugin_array['wptuts'] = plugins_url('js/accordian-button.js', __FILE__);
	return $plugin_array;
}

function ppmaccordionb($buttons) {
	array_push ($buttons, 'ppmaccordiontriger');
	return $buttons;
}
add_action ('init', 'ppmaccordion_button'); 



/* Generates Toggles Shortcode */
function ppm_accordion_main($atts, $content = null) {
	return ('<div id="anther_accordion">'.do_shortcode($content).'</div>');
}
add_shortcode ("mamaccordion", "ppm_accordion_main");

function ppm_accordion_toggles($atts, $content = null) {
	extract(shortcode_atts(array(
        'title'      => '',
        'color'      => ''
    ), $atts));
	
	return ('<h3 style="background:'.$color.'">' .$title. '</h3><div><div class="content"><p>' .$content. '</p></div></div>');
}
add_shortcode ("item", "ppm_accordion_toggles");









?>
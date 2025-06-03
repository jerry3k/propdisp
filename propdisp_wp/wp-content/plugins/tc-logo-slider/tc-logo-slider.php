<?php
/**
 * Plugin Name:		   TC Logo Slider
 * Plugin URI:		   https://www.themescode.com/items/tc-logo-slider
 * Description:		   Logo Slider Carousel is an easy plugin to display logo carousel slider of clients, business partners or affiliates along with title, URL on your website.
 * Version: 		      1.8
 * Author: 			   themesCode
 * Author URI: 		   https://www.themescode.com/items/tc-logo-slider
 * Text Domain:        tc-logo-slider
 * License:            GPL-2.0+
 * License URI:      http://www.gnu.org/licenses/gpl-2.0.txt
 * License: GPL2
 */
 //  Setting API

  require_once dirname( __FILE__ ) . '/lib/settings/class.settings-api.php';
  require_once dirname( __FILE__ ) . '/lib/settings/tc-logo-settings.php';

 new TC_Settings_API_Test();
// include files
 include(plugin_dir_path( __FILE__ ).'/lib/tc-logo-cpt.php');
 include(plugin_dir_path( __FILE__ ).'/lib/tc-logo-metabox.php');
 include(plugin_dir_path( __FILE__ ).'/lib/tc-logo-column.php');
 include(plugin_dir_path( __FILE__ ).'/public/tc-logo-view.php');
 include(plugin_dir_path( __FILE__ ).'/lib/tc-aq-resizer.php');

 function tc_logo_slider_enqueue_scripts() {
   // Vendors style & scripts
    wp_enqueue_style('owl.carousel', plugins_url('vendors/owl-carousel-2/assets/owl.carousel.css', __FILE__ ));
    wp_enqueue_script('owl-carousel', plugins_url('vendors/owl-carousel-2/owl.carousel.min.js', __FILE__ ), array('jquery'), 1.0, true);
    //Plugin Main CSS File
    wp_enqueue_style( 'font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
     wp_enqueue_style( 'tcls', plugins_url('assets/css/tcls.css', __FILE__ ) );
  }

 add_action( 'wp_enqueue_scripts', 'tc_logo_slider_enqueue_scripts' );

 function tc_logoslider_admin_style() {

  wp_enqueue_style( 'tc_logo_admin', plugins_url('assets/css/tc-logo-admin.css',__FILE__ ));

 }
 add_action( 'admin_enqueue_scripts', 'tc_logoslider_admin_style' );


 if ( function_exists( 'add_theme_support' ) ) {
     add_theme_support( 'post-thumbnails' );
 }
 // Sub Menu Page


 add_action('admin_menu', 'tc_tclogoslider_menu_init');



 function tc_tclogoslider_menu_help(){
   include('lib/tc-logoslider-help-upgrade.php');
 }





 function tc_tclogoslider_menu_init()
   {

     add_submenu_page('edit.php?post_type=tclogoslider', __('Help & Upgrade','tc-tcmembers'), __('Help & Upgrade','tc-flexslider'), 'manage_options', 'tc_tclogoslider_menu_help', 'tc_tclogoslider_menu_help');

   }
   /* Move Featured Image Below Title */

   function tc_logo_move_featured_image_box() {
       remove_meta_box( 'postimagediv', 'tclogoslider', 'side' );
       add_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', 'tclogoslider', 'normal', 'high');

   }
   add_action('do_meta_boxes', 'tc_logo_move_featured_image_box');


 // After Plugin Activation redirect

  if( !function_exists( 'tc_logo_after_activation_redirect' ) ){
    function tc_logo_after_activation_redirect( $plugin ) {
        if( $plugin == plugin_basename( __FILE__ ) ) {
            exit( wp_redirect( admin_url( 'edit.php?post_type=tclogoslider&page=tc_tclogoslider_menu_help' ) ) );
        }
    }
  }
  add_action( 'activated_plugin', 'tc_logo_after_activation_redirect' );

// adding link
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'tc_logo_plugin_action_links' );

function tc_logo_plugin_action_links( $links ) {
   $links[] = '<a class="tc-pro-link" href="https://www.themescode.com/items/tc-logo-slider/" target="_blank">Go Pro !</a>';
   $links[] = '<a href="https://www.themescode.com/items/category/wordpress-plugins" target="_blank">TC Plugins</a>';
   return $links;
}

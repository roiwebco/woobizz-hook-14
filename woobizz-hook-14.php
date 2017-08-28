<?php
/*
Plugin Name: Woobizz Hook 14
Plugin URI: http://woobizz.com
Description: Change default preloader 
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook14
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook14_load_textdomain' );
function woobizzhook14_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook1', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	//Hook(s) 14
	add_action('wp_head', 'woobizzhook14_change_woocommerce_preloader', 100);	
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook14_admin_notice' );
}
//Add Hook 14
function woobizzhook14_change_woocommerce_preloader(){
	$url = site_url();
	echo"
	<style> 
	.blockUI.blockOverlay:before{
		content: '';
		background: url(".$url."/wp-admin/images/spinner-2x.gif) center center;
		background-size: cover;
	}
	a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart.loading:after {
		content: '';
		background: url(".$url."/wp-admin/images/spinner-2x.gif) center center;
		background-size: cover;
	}
	</style>
	";
}
//Hook14 Notice
function woobizzhook14_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 14 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook14' ); ?></p>
    </div>
    <?php
}
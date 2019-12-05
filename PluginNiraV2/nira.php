<?php
/*
Plugin Name: nira 

Description: plugin pour faire un don
Author: Sririus HUB 2019
Version: 1.0.0
*/

/*
infos trés importants pour la donation ces infos existent sur le compte developeur du client (qui reçoit l'argent)sur 'paypal developer'->dashboard 
LIVE: 
//client id est utilisé dans deux fichier : 1)nira.php 2)include->init.php :
clientID :AQv7X0Z2ePVL2r4QWbrWbzdg3Brgp5TatF6utUEMe-usVCtnlwfFKCrQIGXjNdSFSIS0VG7lUIPsbeoP
//client secret est utilisé dans un seul fichier : 1)include->init.php :
ClientSercret: EHlldnYgV-cvKK1oyTwkaACY-dSXPDrVGocF-AxddrS6HKM6PXmhlZop64I0ubI37sfXg4XA_hD-tzhX

//on utiliste sandbox en cas de faire un test seulement
sandbox: 
clientID:Aafk10LFp5Himjn3WbrNdC9r0B4LZR7uuWP3p21HKJb1cP7ZDs5WvT4w2Mr8044DXgG1YH0v3f1hvRMw
ClientSercret:ECO_eVEPZhkJcwGEWj_Q6DTIbMNf_T4pCRQAmSqHqJ5L6oaGO8bnkBpUxACrgBzPvDMeoUicqlfG2gbC
 */
function mira_init() 
{
    add_shortcode("mira", "mira_test");
}

add_action( 'wp_enqueue_scripts', 'mira_enqueue_scripts' );
  
  
function mira_enqueue_scripts()
{
      //paypal SDK
      wp_enqueue_script( 'paypal', 'https://www.paypal.com/sdk/js?client-id=AQv7X0Z2ePVL2r4QWbrWbzdg3Brgp5TatF6utUEMe-usVCtnlwfFKCrQIGXjNdSFSIS0VG7lUIPsbeoP&currency=EUR&locale=fr_BE&disable-funding=credit,sofort',array(),null);
      //paypal smart buttons 
      wp_enqueue_script('test', plugins_url('js/paypal_js.js', __FILE__), array('jquery' ,'paypal'),'1.1', true);
      wp_localize_script('test', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
      //style CSS
      wp_enqueue_style('cl-chanimal-styles', plugin_dir_url( __FILE__ ) . 'css/main.css' );
      wp_enqueue_style("fonts","https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i");
      wp_enqueue_style("yonts","vendors/font-awesome-4.7/css/font-awesome.min.css");
      wp_enqueue_style("bants","vendors/mdi-font/css/material-design-iconic-font.min.css");
}
  // use the registered jquery and style above
add_action("init","mira_init");
function mira_test()
{
    ob_start();
    include( plugin_dir_path( __FILE__ ) . 'include/form.php');
    return ob_get_clean();
}   

add_action( 'wp_ajax_nira_transaction', 'nira_transaction' );
add_action( 'wp_ajax_nopriv_nira_transaction', 'nira_transaction' );

//create database if not exists
register_activation_hook( __FILE__, 'my_plugin_create_db' );
function my_plugin_create_db() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'donneur';
      
	$sql = " CREATE TABLE IF NOT EXISTS $table_name  (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `fname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
        `lname` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
        `donation_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
        `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
        `ad1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
        `codepostal` int(10) NOT NULL,
        `city` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
        `montant` int(10) NOT NULL,
        `gsm` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
        `status` int(11) NOT NULL
      );
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
//end create database if doesn't exists

function nira_transaction() 
{
    $orderID = $_POST['orderID'];
    $gsm = $_POST['gsm'];
    require_once('include/transaction.php');
}
<?php
/*
Plugin Name: Donneurs
Version: 1.1
*/

 register_activation_hook( __FILE__, 'nira_create_dataBase' );

function nira_create_dataBase()
{

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'donneur';
    
    $sql =  "
    CREATE TABLE IF NOT EXISTS `$table_name` (
            `id` int(11) AUTO_INCREMENT primary key ,
            `fname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `lname` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `donation_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `ad1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `codepostal` int(10) ,
            `city` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `montant` int(10) ,
            `gsm` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ,
            `status` int(11) ,
            `date` timestamp  DEFAULT CURRENT_TIMESTAMP
          ) $charset_collate;";

          require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
          dbDelta( $sql );
    

} 


add_action( 'wp_ajax_donneurs_valide', 'donneurs_valide' );
add_action( 'wp_ajax_nopriv_donneurs_valide', 'donneurs_valide' );

function donneurs_valide()
{
    $id = $_POST['id'];
    echo $id ;

    
	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'donneur';  


    $res = $wpdb->update(
    $table_name,
    array(
        "status" =>  "1"
    ),
    array(
        'id' => $id
    ),
    array(
        "%d",
    ),
    array(
        "%d",
    ));

    var_dump($res);
    /*  $where_format = null */ 

    //update status on id 
    die();
}



add_action( 'admin_enqueue_scripts', 'donneurs_enqueue_scripts' );
function donneurs_enqueue_scripts()
{
    wp_enqueue_script('donneurs', plugins_url('js/donneurs.js', __FILE__), array('jquery'),'1.1', true);
}

add_action('admin_menu', 'Donneurs_admin_menu');
function Donneurs_admin_menu()
{
    $page_title = 'Donneurs';
    $menu_title = 'Donneurs';
    $capability = 'edit_posts';
    $menu_slug = 'Donneurs_page';
    $function = 'my_Donneurs_page_display';
    $icon_url = 'dashicons-buddicons-buddypress-logo';
    $position = 24;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

function my_Donneurs_page_display()
{
    require "display.php";
}
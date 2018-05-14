<?php
/**
* Plugin Name: Lesprojekt Brno a.s. (custom enhancements)
* Description: Editování kontaktů na stránce s kontakty, editování hotových projektů na stránce s tímto seznamem.
* Authro: Karel Suchomel
* Version: 1.0
* License: GPLv2
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

// remove all metaboxes from dashboard page and remove unused menu items
require_once( plugin_dir_path(__FILE__) . 'lspbce-filter-default-wordpress-ui.php');

// create custom post type for contacts. ( featured image, name, position, e-mail, telephone )
require_once( plugin_dir_path(__FILE__) . 'lspbce-register-contact-post-type.php');

// create custom post type for projects. ( name, year, LHP/LHO )
require_once( plugin_dir_path(__FILE__) . 'lspbce-register-projects-post-type.php');

// create custom post type for examples. ( name, picture, annotation, full details )
require_once( plugin_dir_path(__FILE__) . 'lspbce-register-example-post-type.php');

// contact post, custom field
require_once( plugin_dir_path(__FILE__) . 'fields/lspbce-contact-fields.php');

// project post, custom field
require_once( plugin_dir_path(__FILE__) . 'fields/lspbce-project-fields.php');

// example post, custom field
require_once( plugin_dir_path(__FILE__) . 'fields/lspbce-example-fields.php');

// takes saved featured image and saves it's copy with gaussian blur
require_once( plugin_dir_path(__FILE__) . 'fields/lspbce-page-featured-image-actions.php');

// function lspbce_admin_engueue_scripts() 
// {
// 	global $pagenow, $typenow;
// 	var_dump($pagenow);
// }
// add_action( 'admin_engueue_scripts', 'lspbce_admin_engueue_scripts' );
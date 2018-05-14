<?php
// create custom post type for contacts. ( featured image, name, position, e-mail, telephone )
function lspbce_register_post_type_contact() 
{
	$singular = "Kontakt";
	$plural = "Kontakty";

	$labels = array(
		'name' 								=> $plural,
		'singular_name' 			=> $singular,
		'add_name'						=> 'Přidat nový',
		'add_new_item' 				=> 'Přidat nový ' . $singular,
		'edit' 								=> 'Upravit',
		'edit_item' 					=> 'Upravit ' . $singular,
		'new_item' 						=> 'Nový ' . $singular,
		'view' 								=> 'Zobrazit ' . $singular,
		'view_item' 					=> 'Zobrazit ' . $singular,
		'search_term' 				=> 'Prohledat ' . $plural,
		'parent' 							=> 'Parent ' . $singular,
		'not_found' 					=> 'Žádné ' . $plural . ' nenalezeny',
		'not_found_in_trash' 	=> 'Žádné ' . $plural . ' v koši nenalezeny'
	);

	$args = array(
		'labels'							=> $labels,
		'public'							=> true,
		'publicly_queryable'	=> true,
		'exclude_from_search'	=> true,
		'show_ui'							=> true,
		'show_in_menu'				=> true,
		'query_var'						=> true,
		'can_export'					=> true,
		'menu_icon'						=> 'dashicons-id',
		'rewrite'							=> array( 'slug' => 'contacts' ),
		'capability_type'			=> 'post',
		'hierarchical'				=> false,
		'has_archive'					=> true,
		'menu_position'				=> null,
		'supports'						=> array( 'thumbnail', 'custom_fields' )
	);
	register_post_type( 'contact', $args );
}
add_action( 'init', 'lspbce_register_post_type_contact' );
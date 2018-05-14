<?php
// create custom post type for projects. ( name, year, LHP/LHO )
function lspbce_register_post_type_project() 
{
	$singular = "vyhotovenou zakázku";
	$plural = "Vyhotovené zakázky";

	$labels = array(
		'name' 								=> $plural,
		'singular_name' 			=> $singular,
		'add_name'						=> 'Přidat novou',
		'add_new_item' 				=> 'Přidat novou ' . $singular,
		'edit' 								=> 'Upravit',
		'edit_item' 					=> 'Upravit ' . $singular,
		'new_item' 						=> 'Nová ' . $singular,
		'view' 								=> 'Zobrazit ' . $singular,
		'view_item' 					=> 'Zobrazit ' . $singular,
		'search_term' 				=> 'Prohledat ' . $plural,
		'parent' 							=> 'Parent ' . $singular,
		'not_found' 					=> 'Žádné ' . $plural . ' nenalezeny',
		'not_found_in_trash' 	=> 'Žádné ' . $plural . ' v koši nenalezeny'
	);

	$args = array(
		'labels'							=> $labels,
		'show_in_rest' 				=> true,
		'rest_base'						=> 'projects',
		'public'							=> true,
		'publicly_queryable'	=> true,
		'exclude_from_search'	=> true,
		'show_ui'							=> true,
		'show_in_menu'				=> true,
		'query_var'						=> true,
		'can_export'					=> true,
		'menu_icon'						=> 'dashicons-portfolio',
		'rewrite'							=> array( 'slug' => 'projects' ),
		'capability_type'			=> 'post',
		'hierarchical'				=> false,
		'has_archive'					=> true,
		'menu_position'				=> null,
		'supports'						=> array( 'custom_fields' )
	);
	register_post_type( 'project', $args );
}
add_action( 'init', 'lspbce_register_post_type_project' );
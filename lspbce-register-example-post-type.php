<?php
// create custom post type for contacts. ( featured image, name, position, e-mail, telephone )
function lspbce_register_post_type_example() 
{
	$singular = "Ukázku";
	$plural = "Ukázky";

	$labels = array(
		'name' 								=> $plural,
		'singular_name' 			=> $singular,
		'add_name'						=> 'Přidat novou',
		'add_new_item' 				=> 'Přidat novou ' . $singular,
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
		'exclude_from_search'	=> false,
		'show_ui'							=> true,
		'show_in_menu'				=> true,
		'query_var'						=> true,
		'can_export'					=> true,
		'menu_icon'						=> 'dashicons-images-alt',
		'rewrite'							=> array( 'slug' => 'example' ),
		'capability_type'			=> 'post',
		'hierarchical'				=> false,
		'has_archive'					=> true,
		'menu_position'				=> null,
		'supports'						=> array( 'thumbnail', 'custom_fields' )
	);
	register_post_type( 'example', $args );
}
add_action( 'init', 'lspbce_register_post_type_example' );

function lspbce_register_taxonomy_example() 
{
	$singular = 'Typ ukázky';
	$plural = 'Typy ukázek';

	$labels = array(
		'name' => $plural,
		'singular_name' => $singular,
		'search_items' => 'Prohledat ' . $plural,
		'all_items' => 'Všechny ' . $plural,
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => 'Upravit ' . $singular,
		'update_item' => 'Aktualizovat ' . $singular,
		'add_new_item' => 'Přidat nový ' . $singular,
		'new_item_name' => 'Nový ' . $singular,
		'separate_items_with_commas' => 'Rozdělit ' . $plural . ' čárkami',
		'add_or_remove_items' => 'Přidat nebo odebrat ' . $plural,
		'choose_from_most_used' => 'Vybrat z neojpoužívanějších typů ukázek',
		'not_found' => 'Žádné ' . $plural . ' nenalezeny',
		'menu_name' => $plural,
	);

	$args = array(
		'hierarchical'					=> false,
		'labels' 								=> $labels,
		'show_ui'								=> true,
		'show_admin_column'			=> true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'							=> true,
		'rewrite'								=> array( 'slug' => 'example_type' )
	);

	register_taxonomy( 'example_type', 'example', $args );
}
add_action( 'init', 'lspbce_register_taxonomy_example' );
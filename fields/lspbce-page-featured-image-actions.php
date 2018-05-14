<?php
require_once( plugin_dir_path(__FILE__) .  "../inc/blur-image.php");

function lspbce_page_gaussian_blur()
{
	add_meta_box(
		'lspb_page_meta',
		__( 'Detail stránky' ),
		'lspb_page_meta_callback',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'lspbce_page_gaussian_blur' );

function lspb_page_meta_callback( $post )
{
	// security feature
	wp_nonce_field( basename( __FILE__ ), 'lspb_page_nonce' );
	$lspb_stored_data = get_post_meta( $post->ID );
}

function lspb_page_meta_save( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['lspb_page_nonce'] ) && wp_verify_nonce( $_POST['lspb_page_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';

	// Exists script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce )
	{
		return;
	}

	if (get_post_meta( $post_id, "_thumbnail_id", true ) !== "")
	{
		$thumID = get_post_meta( $post_id, "_thumbnail_id", true );
		//$attsrc = get_post_meta( $thumID, "_wp_attached_file", true );
		$attsrc = wp_get_attachment_image_src( $thumID, 'full', false);

		// create blurred version
		$blurrIMGurl = blurImage( $attsrc[0] );

		update_post_meta( $post_id, '_wp_attached_file_blur', $blurrIMGurl );
	}

}
add_action( 'save_post', 'lspb_page_meta_save' );
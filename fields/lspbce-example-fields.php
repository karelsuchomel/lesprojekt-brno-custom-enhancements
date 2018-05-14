<?php

function lspbce_add_custom_metabox_example()
{
	add_meta_box(
		'lspb_example_meta',
		__( 'Detail ukázky' ),
		'lspb_example_meta_callback',
		'example',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'lspbce_add_custom_metabox_example' );

function lspb_example_meta_callback( $post )
{
	// security feature
	wp_nonce_field( basename( __FILE__ ), 'lspb_example_nonce' );
	$lspb_stored_data = get_post_meta( $post->ID );
?>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="example-name" class="row-title">Nadpis ukázky</label>
			</div>
			<div class="meta-td">
				<input type="text" name="example-name" id="example-name" value="<?php if ( ! empty($lspb_stored_data['example-name']) ) echo esc_attr( $lspb_stored_data['example-name'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="example-annotation" class="row-title">Krátký popis</label>
			</div>
			<div class="meta-td">
				<textarea name="example-annotation" id="example-annotation"><?php if ( ! empty($lspb_stored_data['example-annotation']) ) echo esc_attr( $lspb_stored_data['example-annotation'][0] ); ?></textarea>
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="example-details" class="row-title">Popis</label>
			</div>
		<?php

		$content = get_post_meta( $post->ID, 'example-details', true );
		$editor = 'example-details';
		$settings = array(
			'wpautop' => false,
			'textarea_rows' => 8,
			'media_buttons' => false,
		);

		wp_editor( $content, $editor, $settings); ?>
	</div>
<?php	
}

function lspb_example_meta_save( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['lspb_example_nonce'] ) && wp_verify_nonce( $_POST['lspb_example_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';

	// Exists script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce )
	{
		return;
	}

	if ( isset( $_POST['example-name'] ) )
	{
		update_post_meta( $post_id, 'example-name', sanitize_text_field( $_POST['example-name'] ) );

		// insert title
		global $wpdb;
		$where = array( 'ID' => $post_id );
		$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST['example-name'] ), $where );
	}
	if ( isset( $_POST['example-annotation'] ) )
	{
		update_post_meta( $post_id, 'example-annotation', sanitize_text_field( $_POST['example-annotation'] ) );
	}
	if ( isset( $_POST['example-details'] ) )
	{
		update_post_meta( $post_id, 'example-details', wp_kses_post( $_POST['example-details'] ) );
	}
}
add_action( 'save_post', 'lspb_example_meta_save' );
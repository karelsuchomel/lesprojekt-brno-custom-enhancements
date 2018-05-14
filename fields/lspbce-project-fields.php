<?php

function lspbce_add_custom_metabox_project()
{
	add_meta_box(
		'lspb_project_meta',
		__( 'Detail projektu' ),
		'lspb_project_meta_callback',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'lspbce_add_custom_metabox_project' );

function lspb_project_meta_callback( $post )
{
	// security feature
	wp_nonce_field( basename( __FILE__ ), 'lspb_project_nonce' );
	$lspb_stored_data = get_post_meta( $post->ID );
?>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="project-name" class="row-title">Název zakázky</label>
			</div>
			<div class="meta-td">
				<input type="text" name="project-name" id="project-name" value="<?php if ( ! empty($lspb_stored_data['project-name']) ) echo esc_attr( $lspb_stored_data['project-name'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="project-type" class="row-title">Typ zakázky</label>
			</div>
			<div class="meta-td">
				<input type="text" name="project-type" id="project-type" value="<?php if ( ! empty($lspb_stored_data['project-type']) ) echo esc_attr( $lspb_stored_data['project-type'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="project-importance" class="row-title">Důležitost zakázky</label>
			</div>
			<div class="meta-td">
				<input type="number" name="project-importance" id="project-importance" value="<?php if ( ! empty($lspb_stored_data['project-importance']) ) { echo esc_attr($lspb_stored_data['project-importance'][0]);} else { echo '0'; }?>" >
			</div>
		</div>
	</div>
<?php	
}

function lspb_project_meta_save( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['lspb_project_nonce'] ) && wp_verify_nonce( $_POST['lspb_project_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';

	// Exists script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce )
	{
		return;
	}

	if ( isset( $_POST['project-name'] ) )
	{
		update_post_meta( $post_id, 'project-name', sanitize_text_field( $_POST['project-name'] ) );

		// insert title
		global $wpdb;
		$where = array( 'ID' => $post_id );
		$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST['project-name'] ), $where );
	}
	if ( isset( $_POST['project-type'] ) )
	{
		update_post_meta( $post_id, 'project-type', sanitize_text_field( $_POST['project-type'] ) );
	}
	if ( isset( $_POST['project-importance'] ) )
	{
		update_post_meta( $post_id, 'project-importance', sanitize_text_field( $_POST['project-importance'] ) );
	} else {
		update_post_meta( $post_id, 'project-importance', 0 );
	}
}
add_action( 'save_post', 'lspb_project_meta_save' );
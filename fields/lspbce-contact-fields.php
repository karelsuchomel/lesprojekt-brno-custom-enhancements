<?php

function lspbce_add_custom_metabox_contact()
{
	add_meta_box(
		'lspb_contact_meta',
		__( 'Detail kontaktu' ),
		'lspb_contact_meta_callback',
		'contact',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'lspbce_add_custom_metabox_contact' );

function lspb_contact_meta_callback( $post )
{
	// security feature
	wp_nonce_field( basename( __FILE__ ), 'lspb_contact_nonce' );
	$lspb_stored_data = get_post_meta( $post->ID );
?>
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="contact-name" class="row-title">Jméno</label>
			</div>
			<div class="meta-td">
				<input type="text" name="contact-name" id="contact-name" value="<?php if ( ! empty($lspb_stored_data['contact-name']) ) echo esc_attr( $lspb_stored_data['contact-name'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="contact-personal-title" class="row-title">Titul před jménem</label>
			</div>
			<div class="meta-td">
				<input type="text" name="contact-personal-title" id="contact-personal-title" value="<?php if ( ! empty($lspb_stored_data['contact-personal-title']) ) echo esc_attr( $lspb_stored_data['contact-personal-title'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="contact-position" class="row-title">Pozice</label>
			</div>
			<div class="meta-td">
				<input type="text" name="contact-position" id="contact-position" value="<?php if ( ! empty($lspb_stored_data['contact-position']) ) echo esc_attr( $lspb_stored_data['contact-position'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="contact-mail" class="row-title">E-mail</label>
			</div>
			<div class="meta-td">
				<input type="email" name="contact-mail" id="contact-mail" value="<?php if ( ! empty($lspb_stored_data['contact-mail']) ) echo esc_attr( $lspb_stored_data['contact-mail'][0] ); ?>">
			</div>
		</div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="contact-tel" class="row-title">Telefon</label>
			</div>
			<div class="meta-td">
				<input type="tel" name="contact-tel" id="contact-tel" value="<?php if ( ! empty($lspb_stored_data['contact-tel']) ) echo esc_attr( $lspb_stored_data['contact-tel'][0] ); ?>">
			</div>
		</div>
	</div>
<?php	
}

function lspb_contact_meta_save( $post_id )
{
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST['lspb_contact_nonce'] ) && wp_verify_nonce( $_POST['lspb_contact_nonce'], basename(__FILE__) ) ) ? 'true' : 'false';

	// Exists script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce )
	{
		return;
	}

	if ( isset( $_POST['contact-name'] ) )
	{
		update_post_meta( $post_id, 'contact-name', sanitize_text_field( $_POST['contact-name'] ) );

		// insert title
		global $wpdb;
		$where = array( 'ID' => $post_id );
		$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST['contact-name'] ), $where );
	}
	if ( isset( $_POST['contact-personal-title'] ) )
	{
		update_post_meta( $post_id, 'contact-personal-title', sanitize_text_field( $_POST['contact-personal-title'] ) );
	}
	if ( isset( $_POST['contact-position'] ) )
	{
		update_post_meta( $post_id, 'contact-position', sanitize_text_field( $_POST['contact-position'] ) );
	}
	if ( isset( $_POST['contact-mail'] ) )
	{
		update_post_meta( $post_id, 'contact-mail', sanitize_text_field( $_POST['contact-mail'] ) );
	}
	if ( isset( $_POST['contact-tel'] ) )
	{
		update_post_meta( $post_id, 'contact-tel', sanitize_text_field( $_POST['contact-tel'] ) );
	}

}
add_action( 'save_post', 'lspb_contact_meta_save' );
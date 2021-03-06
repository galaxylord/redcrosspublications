<?php
$scporder_options = get_option( 'scporder_options' );
$objects = $scporder_options['objects'];
?>

<div class="wrapper">

	<?php screen_icon( 'plugins' ); ?>

	<h2><?php _e( 'Simple Custom Post Order Settings', 'scporder' ); ?></h2> 
	<?php if ( isset( $_GET['msg'] ) ) : ?>
		<br>
		<div id="message" class="updated below-h2">
			<?php if ( $_GET['msg'] == 'update' ) : ?>
				<p><?php _e( 'Settings saved.', 'scporder' ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?> 
	<form method="post">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="blogname"><?php _e( 'Sortable Objects', 'scporder' ) ?></label></th>
					<td>
						<input type="hidden" name="msg" value="true" /> 
						<?php if ( function_exists( 'wp_nonce_field' ) ) wp_nonce_field( 'nonce_scporder' ); ?>



						<?php
						$post_types = get_post_types( array(
							'public' => true
								), 'objects' );
						?>

						<?php
						foreach ( $post_types as $post_type ) {
							if ( $post_type->name != 'attachment' ) {
								?>
								<label><input type="checkbox" name="objects[]" value="<?php echo $post_type->name; ?>" <?php
									if ( isset( $objects ) && is_array( $objects ) ) {
										if ( in_array( $post_type->name, $objects ) ) {
											echo 'checked="checked"';
										}
									}
									?> />&nbsp;<?php echo $post_type->label; ?></label><br />

								<?php
							}
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary" name="scporder_submit" value="<?php _e( 'Update', 'scpo' ); ?>" />
		</p>

	</form>


</div>

<?php

function taxonomy_order_update() { 
	if ( $_POST['taxonomy_order'] == 'on' ) {
		$display = 'checked';
	} else {
		$display = '';
	}
	update_option( 'order_taxonomy', $display );
}
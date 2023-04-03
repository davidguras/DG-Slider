<?php

$link_text = get_post_meta( $post->ID, 'dg_slider_link_text', true );
$link_url  = get_post_meta( $post->ID, 'dg_slider_link_url', true );
?>

<table class="form-table dg-slider-metabox">
	<input type="hidden" name="dg_slide_nonce" value="<?= wp_create_nonce( 'dg_slider_nonce' ) ?>">
	<tr>
		<th>
			<label for="dg_slider_link_text">Link Text</label>
		</th>
		<td>
			<input
				type="text"
				name="dg_slider_link_text"
				id="dg_slider_link_text"
				class="regular-text link-text"
				value="<?= esc_html( $link_text ?? 'Enter some text' ) ?>"
				required
			>
		</td>
	</tr>
	<tr>
		<th>
			<label for="dg_slider_link_url">Link URL</label>
		</th>
		<td>
			<input
				type="url"
				name="dg_slider_link_url"
				id="dg_slider_link_url"
				class="regular-text link-url"
				value="<?= esc_url( $link_url ?? '#' ) ?>"
				required
			>
		</td>
	</tr>
</table>
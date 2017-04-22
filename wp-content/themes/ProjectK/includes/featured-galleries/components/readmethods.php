<?php

function get_post_gallery_ids($id,$max_images=-1,$method="array") {

	if (is_preview($id)) {

		$galleryString = get_post_meta( $id, 'fg_temp_metadata', 1);

	}

	else {

		$galleryString = get_post_meta( $id, 'fg_perm_metadata', 1);

	}

	if ($method == "string" || $max_images == "string") {

		return $galleryString;

	}

	else {

		if ($max_images == -1) {

			return explode(',', $galleryString);

		}

		else {

			return array_slice(explode(',', $galleryString), 0, $max_images);

		}

	}

}
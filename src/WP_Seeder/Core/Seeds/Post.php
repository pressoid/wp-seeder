<?php

namespace WP_Seeder\Core\Seeds;

use WP_Post;
use WP_Seeder\Core\Seeds\Traits\Current_Date;

class Post extends Seed {

	use Current_Date;

	/**
	 * Gets default values of post seed properties.
	 *
	 * @return array
	 */
	public function defaults() {
		$title = $this->faker->sentence();
		$slug  = sanitize_title( $title );

		return array(
			'post_author'       => 1,
			'post_type'         => 'post',
			'post_status'       => 'publish',
			'post_name'         => $slug,
			'post_title'        => $title,
			'post_date'         => $this->now(),
			'post_date_gmt'     => $this->now(),
			'post_modified'     => $this->now(),
			'post_modified_gmt' => $this->now(),
			'post_content'      => $this->faker->realText( 2000 ),
			'post_excerpt'      => $this->faker->realText( 200 ),
			'post_thumbnail'    => array(
				'url'  => 'https://unsplash.it/1140/768/?random',
				'name' => str_replace( '.', '', $this->faker->sentence() ),
			),
		);
	}

	/**
	 * Generates entry of post seed.
	 *
	 * @return void
	 */
	public function generate() {
		$this->properties = array_merge( $this->defaults(), $this->properties );

		$post = wp_insert_post( $this->properties );

		$this->add_meta( $post );
		$this->add_thumbnail( $post );

		return $post;
	}

	/**
	 * Adds meta data to the post.
	 *
	 * @param integer $post
	 */
	public function add_meta( $post ) {
		if ( isset( $this->properties['post_meta'] ) && is_array( $this->properties['post_meta'] ) ) {
			foreach ( $this->properties['post_meta'] as $key => $value ) {
				add_post_meta( $post, $key, $value );
			}
		}
	}

	/**
	 * Adds thumbnail image to the post.
	 *
	 * @param integer $post
	 */
	public function add_thumbnail( $post ) {
		if ( isset( $this->properties['post_thumbnail'] ) ) {
			$attributes = array(
				'tmp_name' => download_url( $this->properties['post_thumbnail']['url'] ),
				'name'     => $this->properties['post_thumbnail']['name'] . '.jpg',
				'type'     => 'image/jpg',
			);

			if ( ! is_wp_error( $attributes['tmp_name'] ) ) {
				$media = media_handle_sideload( $attributes, $post );

				if ( ! is_wp_error( $media ) ) {
					set_post_thumbnail( $post, $media );
				} else {
					unlink( $attributes['url'] );
				}
			}
		}
	}
}

<?php

namespace WPSeeder\Seeds;

use WPSeeder\Seeds\Traits\CurrentDate;

class Post extends Seed
{
	use CurrentDate;

	/**
	 * Gets default values of post seed properties.
	 *
	 * @return array
	 */
	public function defaults()
	{
		$title = $this->faker->sentence();
		$slug = sanitize_title($title);

		return [
			'post_author' => 1,
			'post_type' => 'post',
			'post_status' => 'publish',
			'post_name' => $slug,
			'post_title' => $title,
			'post_date' => $this->now(),
			'post_date_gmt' => $this->now(),
			'post_modified' => $this->now(),
			'post_modified_gmt' => $this->now(),
			'post_content' => $this->faker->text(),
			'post_excerpt' => $this->faker->sentence(12),
		];
	}

	/**
	 * Generates entry of post seed.
	 *
	 * @return void
	 */
	public function generate()
	{
		$post = wp_insert_post(array_merge($this->defaults(), $this->properties));

		if (isset($this->properties['post_meta']) && is_array($this->properties['post_meta'])) {
			foreach ($this->properties['post_meta'] as $key => $value) {
				add_post_meta($post, $key, $value);
			}
		}

		return $post;
	}
}
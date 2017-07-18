<?php

namespace WPSeeder\Seeds;

use WPSeeder\Seeds\Traits\CurrentDate;

class Post extends Seed
{
	use CurrentDate;

	public function create()
	{
		$post = wp_insert_post(array_merge($this->defaults(), $this->properties));

		if (isset($this->properties['post_meta']) && is_array($this->properties['post_meta'])) {
			foreach ($this->properties['post_meta'] as $key => $value) {
				add_post_meta($post, $key, $value);
			}
		}

		return $post;
	}

	public function defaults()
	{
		$title = $this->faker->sentence();

		return [
			'post_author' => 1,
			'post_type' => 'post',
			'post_status' => 'publish',

			'post_date' => $this->now(),
			'post_date_gmt' => $this->now(),
			'post_modified' => $this->now(),
			'post_modified_gmt' => $this->now(),

			'post_title' => $title,
			'post_name' => sanitize_title($title),

			'post_content' => $this->faker->text(),
			'post_excerpt' => $this->faker->sentence(12),
		];
	}
}
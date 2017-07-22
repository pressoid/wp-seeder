<?php

namespace WPSeeder\Seeds;

use WPSeeder\Seeds\Traits\CurrentDate;

class User extends Seed
{
    use CurrentDate;

    /**
     * Gets default values of user seed properties.
     *
     * @return array
     */
    public function defaults()
    {
        return [
            'user_pass' => wp_hash_password('password'),
            'user_login' => $this->faker->unique()->userName(),
            'user_url' => $this->faker->url(),
            'user_email' => $this->faker->unique()->email(),
            'display_name' => $this->faker->name(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'post_excerpt' => $this->faker->realText(200),
            'user_registered' => $this->now(),
        ];
    }

    /**
     * Generates entry of user seed.
     *
     * @return void
     */
    public function generate()
    {
        $user = wp_insert_user(array_merge($this->defaults(), $this->properties));

        if (isset($this->properties['user_meta']) && is_array($this->properties['user_meta'])) {
            foreach ($this->properties['user_meta'] as $key => $value) {
                add_user_meta($user, $key, $value);
            }
        }

        return $user;
    }
}

<?php

namespace WPSeeder;

use Exception;
use WPSeeder\Contracts\SeederInterface;

class Command
{
	/**
	 * Seeder instance.
	 *
	 * @var \WPSeeder\Contracts\SeederInterface
	 */
	protected $seeder;

    /**
     * Command options with default values.
     *
     * @var array
     */
    protected $options = [
        'factories' => [],
    ];

	/**
	 * Construct command.
	 *
	 * @param \WPSeeder\Contracts\SeederInterface $seeder
	 */
	public function __construct(SeederInterface $seeder)
	{
		$this->seeder = $seeder;
	}

	/**
     * Seeds a database with fake content using configured seeding schema.
     *
     * ## OPTIONS
     *
     * [--factories=<names>]
     * : Run seeding with additional factories definitions for standard WordPress objects. Available factories: posts, users.
     *
     * ## EXAMPLES
     *
     *     wp seed --factories="posts:10,users:5"
     *
     * @when after_wp_load
     */
    public function __invoke($arguments, $options)
    {
        $this->setOptions($options);

        try {

            // We will register buildin factories
            // specifed by user and run seeding.
            $this->defineFactories();
            $this->seeder->run();

        } catch (Exception $e) {

            // Provide feedback to the user
            // when something went wrong.
            return \WP_CLI::error($e->getMessage());

        }

        return \WP_CLI::success('Seeded.');
    }

    /**
     * Defines factories specifed in factories option with buildin templates.
     *
     * @return void
     */
    public function defineFactories()
    {
        foreach ($this->getFactories() as $definition) {
            foreach ($definition as $name => $count) {
                if (file_exists($factory = dirname(__DIR__) . "/../factories/{$name}.php")) {
                    include $factory;
                } else {
                    throw new Exception("There is no factory definition for [{$name}] factory.");
                }
            }
        }
    }

    /**
     * Parses factories option and returns factory name and number of items to generate.
     *
     * @return array
     */
    public function getFactories()
    {
        if (! empty($factories = $this->getOption('factories'))) {
            $factories = explode(',', $factories);

            return array_map(function ($factory) {
                $definition = explode(':', $factory);

                return [$definition[0] => intval($definition[1])];
            }, $factories);
        }

        return $factories;
    }

    /**
     * Gets value of `options` property.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets value of the `options` property.
     *
     * @param array $options
     * @return self
     */
    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Gets value of the specifed option.
     *
     * @param string $name
     * @return mixed
     */
    public function getOption($name)
    {
        return $this->options[$name];
    }
}
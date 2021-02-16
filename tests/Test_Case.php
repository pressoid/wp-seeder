<?php

use Brain\Monkey;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class Test_Case extends PHPUnitTestCase {

	use MockeryPHPUnitIntegration;

	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();
	}

	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}
}

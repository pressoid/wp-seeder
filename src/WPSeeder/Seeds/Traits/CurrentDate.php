<?php

namespace WPSeeder\Seeds\Traits;

trait CurrentDate
{
	public function now()
	{
		return date("Y-m-d H:i:s", time());
	}
}
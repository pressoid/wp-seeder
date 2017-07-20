<?php

namespace WPSeeder\Seeds\Traits;

trait CurrentDate
{
    /**
     * Gets current datetime.
     *
     * @return string
     */
    public function now()
    {
        return date("Y-m-d H:i:s", time());
    }
}

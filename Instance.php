<?php

declare(strict_types=1);

namespace App\Helpers;

class Instance {
    
    private static $instances = [];

    /**
     * Get instance 
     * 
     * @param string $key
     * @return mixed $instance
     */
    public static function get(string $key): mixed {
        return self::$instances[ $key ] ?? null;
    }

    /**
     * Set instance
     * 
     * @param string $key
     * @param mixed $instance
     */
    public static function set(string $key, mixed $instance): void {
        self::$instances[ $key ] = $instance;
    }
}
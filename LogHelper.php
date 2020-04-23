<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Helpers\Instance;
use \Psr\Log\LoggerInterface;

class LogHelper {

    /**
     * Get logger instance
     * 
     * @return LoggerInterface $logger
     */
    private static function getLogger(): LoggerInterface {
        return Instance::get('logger');
    }

    /**
     * Write a log message
     * 
     * @param string $message
     */
    public static function critical(string $message): void {
        self::getLogger()->critical($message);
    }

}
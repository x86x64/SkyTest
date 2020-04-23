<?php

declare(strict_types=1);

use App\Helpers\Instance;

// Get ENV_PRODUCTION from somewhere

Instance::set('cache', ENV_PRODUCTION ? $memcacheCache : $nullCache);
Instance::set('logger', ENV_PRODUCTION ? $kibanaLogger : $fileLogger);
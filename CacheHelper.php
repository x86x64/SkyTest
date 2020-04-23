<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Helpers\Instance;
use Psr\Cache\CacheItemPoolInterface;

class CacheHelper {

    /**
     * Get cache instance
     * 
     * @return CacheItemPoolInterface $cache
     */
    private static function getCache(): CacheItemPoolInterface 
    {
        return Instance::get('cache');
    }

    /**
     * Get cache item
     * 
     * @param string $key
     * @return mixed $cacheItem
     */
    private static function getCacheItem(string $key): mixed
    {
        try {
            $cacheItem = self::getCache()->getItem($key);
            return $cacheItem;
        } catch(\Throwable $e) {
            LogHelper::critical($e->getMessage());
            return null;
        }
    }

    /**
     * Get value from cache
     * 
     * @param string $key
     * @return mixed $value
     */
    public static function get(string $key): mixed 
    {
        $cacheItem = self::getCacheItem($key);
        if(!$cacheItem){
            return null;
        }
        if ($cacheItem->isHit()){
            return $cacheItem->get();
        }
        return null;
    }

    /**
     * Set value to cache
     * 
     * @param string $key
     * @param mixed $value
     * @param int $days
     */
    public static function set(string $key, mixed $value, int $days): void 
    {   
        $cacheItem = self::getCacheItem($key);
        if(!$cacheItem){
            return;
        }
        $cacheItem->set($value)->expiresAt((new \DateTime())->modify("+$days day"));
        self::getCache()->save($cacheItem);
    }

}
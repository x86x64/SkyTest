<?php

declare(strict_types=1);

namespace App\Services\Lessons;

use App\Helpers\CacheHelper;
use App\Helpers\LogHelper;

class LessonsGetService {
    
    const CACHE_PREFIX = 'lessons:';

    /**
     * Get lessons
     * 
     * @param int $category
     * @return array $lessons
     */
    public function getLessons(?int $category = 0): array 
    {
        try {
            $cacheKey = self::CACHE_PREFIX . $category;
            $lessons = CacheHelper::get($cacheKey);
            if(!$lessons){
                $lessons = (new LessonsDataProvider())
                    ->get($category);
                CacheHelper::set($cacheKey, $lessons, 1);
            }
            return $lessons;
        }catch(\Throwable $e){
            LogHelper::critical($e->getMessage());
        }
        return [];
    }
}
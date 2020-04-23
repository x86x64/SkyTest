<?php

declare(strict_types=1);

namespace App\Services\Lessons;

class LessonsServiceFactory 
{
    /**
     * Get LessonsGetService
     * 
     * @return LessonsGetService $service
     */
    public function getLessonsGetService(): LessonsGetService {
        return new LessonsGetService();
    }
}
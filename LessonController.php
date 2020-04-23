<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\Lessons\LessonsServiceFactory;
use App\Http\Response;

class LessonController {

    /**
     * Get lessons
     * 
     * @param int $category
     * @param string $returnType
     * @return Response $response
     */
    public function index(?int $category = 0, ?string $returnType = 'json'): void
    {
        $lessons = (new LessonsServiceFactory())
            ->getLessonsGetService()
            ->getLessons($category);
        
        (new Response())
            ->setData($lessons, $returnType)
            ->send();
    }
}
?>

<?php

declare(strict_types=1);

namespace App\Services\Lessons;

use App\Helpers\LogHelper;

class LessonsDataProvider {
    
    const HOST = 'host';
    const AUTH_USER = 'user';
    const AUTH_PASSWORD = 'pass';

    /**
     * Get lessons from 3rd party api
     * 
     * @param int $category
     * @return array $lessons
     */
    public function get(?int $category = 0): array
    {
        if($ch = curl_init()){

            $query = ($category > 0) ? ['categoryId' => $category] : [];

            curl_setopt($ch, CURLOPT_URL, self::HOST . '?' . http_build_query($query));
            curl_setopt($ch, CURLOPT_USERPWD, self::AUTH_USER . ":" . self::AUTH_PASSWORD);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $response = curl_exec($ch);

            if(curl_errno($ch)){
                LogHelper::critical('CURL ERROR '.curl_error($ch));
                curl_close($ch);
                return [];    
            }

            curl_close($ch);
            return json_decode($response, true);
        }
        return [];
    }
}

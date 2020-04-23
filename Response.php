<?php

namespace App\Http;

use SimpleXMLElement;

use App\Helpers\LogHelper;

class Response {

    // Response data
    private $data = '';

    // Content type
    private $returnType;

    const HEADERS = [
        'xml'   => 'text/xml',
        'json'  => 'application/json',
    ];

    /**
     * Set response data
     * 
     * @param mixed $data
     * @param string $type
     */
    public function setData(mixed $data, ?string $type = 'json'): self {
        $this->returnType = $type;
        if($type === 'xml'){
            if(!is_array($data)){
                LogHelper::critical('RESPONSE ERROR. Need an array as input data');
            }else{
                $xml = new SimpleXMLElement('<root/>');
                array_walk_recursive($data, [$xml, 'addChild']);
                $this->data = $xml->asXML();
            }
        }else{
            $this->data = json_encode($data);
        }
        return $this;
    }

    /**
     * Send response
     */
    public function send(): void {
        if(isset(self::HEADERS[ $this->returnType ])){
            header("Content-Type: " . self::HEADERS[ $this->returnType ]);
        }
        echo $this->data;
    }
}
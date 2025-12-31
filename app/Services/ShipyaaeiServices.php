<?php

namespace App\Services;

class ShipyaaeiServices
{

    protected $api_key;
    protected  $api_secret_key;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->api_key = "radha";
        $this->api_secret_key = "ji";
    }

    public function createshipyaari($data){
         return  $data;
    }
}

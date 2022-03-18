<?php

namespace App\Services;

class Page
{
        public static function par($part_name){
            require_once 'views/components/' . $part_name . '.php';
        }
}
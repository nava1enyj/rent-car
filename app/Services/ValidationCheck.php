<?php

namespace App\Services;

class ValidationCheck
{
    public static function protectionAgainstXss($str){
        return strip_tags(trim($str));
    }

}
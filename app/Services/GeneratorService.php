<?php
declare(strict_types=1);

namespace App\Services;

class GeneratorService
{
    public function codeGenerator($category, $number)
    {
        $str = substr($category, 0,3);
        $code = strtoupper($str) . '-'. $number;
        return $code;
    }
}
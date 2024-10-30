<?php

namespace App\Helper;

class Censurator
{
    private array $motsInterdit = ['nain', 'pipe', 'maman'];

    public function censorText(string $text): string
    {
        foreach ($this->motsInterdit as $mot) {
            $text = str_ireplace($mot, '****', $text);
        }

        return $text;
    }


}
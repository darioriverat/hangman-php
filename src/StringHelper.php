<?php
declare(strict_types = 1);

namespace Hangman;

class StringHelper
{
    public static function str_split_unicode(string $str): array
    {
        return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    }

    public static function explode_unique(string $str): array
    {
        $letters = StringHelper::str_split_unicode($str);
        $different_letters = [];

        foreach ($letters as $letter) {
            if (!in_array($letters, $different_letters)) {
                $different_letters[] = $letter;
            }
        }

        return $different_letters;
    }
}
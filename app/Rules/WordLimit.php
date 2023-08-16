<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WordLimit implements Rule
{
private $limit;
    public function __construct($limit)
    {
        $this->limit = $limit;
    }


    public function passes($attribute, $value)
    {
        $wordCount = str_word_count($value);
        return $wordCount <= $this->limit;
    }

    public function message()
    {
        return "The :attribute must not exceed {$this->limit} words.";
    }
}

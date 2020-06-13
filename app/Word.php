<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string word
 */
class Word extends Model
{
    public function getRandomWord(): self
    {
        return $this->inRandomOrder()->first();
    }
}

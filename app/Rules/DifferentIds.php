<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DifferentIds implements Rule
{
    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function passes($attribute, $value)
    {
        return $this->ids[0] != $this->ids[1];
    }

    public function message()
    {
        return 'O item e o componente precisam ser diferentes.';
    }
}

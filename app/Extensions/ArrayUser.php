<?php

namespace App\Extensions;

use Illuminate\Auth\GenericUser;

class ArrayUser extends GenericUser
{
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function getRememberToken()
    {
        return $this->attributes[$this->getRememberTokenName()] ?? '';
    }
}

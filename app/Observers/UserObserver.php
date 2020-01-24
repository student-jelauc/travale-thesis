<?php

namespace App\Observers;

use App\Entities\Account;
use App\Entities\User;

class UserObserver
{
    /**
     * @param User $user
     */
    public function created(User $user)
    {
        Account::create([
            'name' => $user->name,
            'master' => $user->id,
        ]);
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->is_admin) {
            return true;
        }
        return false;
    }

    public function view(User $user): bool
    {
        return true;
    }
}

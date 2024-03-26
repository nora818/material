<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function view(User $user, Book $book): bool
    {
        return $user->id == $book->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function edit(User $user, Book $book): bool
    {
        return $user->id == $book->user_id;
    }
}

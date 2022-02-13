<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    use HandlesAuthorization;

     /**
     * Determine whether the user can create models.
     *
      * @return bool
     */
    public function create():bool
    {
        return self::isAdmin();
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @return bool
     */
    public function delete(): bool
    {
        return self::isAdmin();
    }

    public static function isAdmin(): bool
    {
        $user = Auth::user();
        return ($user && $user->name === 'eugene');
    }

}

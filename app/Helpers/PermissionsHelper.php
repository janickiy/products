<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionsHelper
{
    /**
     * @param string $permissions
     * @return bool
     */
    public static function has_permission(string $permissions = ''): bool
    {
        if (Auth::user()->role === 'admin') return true;

        $permissions = explode('|', $permissions);

        if (in_array(Auth::user()->role, $permissions)) {
            return true;
        } else {
            return false;
        }
    }
}

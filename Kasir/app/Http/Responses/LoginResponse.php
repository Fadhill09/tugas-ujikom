<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements Responsable
{
    /**
     * Create an HTTP response that represents the object.
     */
    public function toResponse($request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        }

        // fallback kalau role nggak dikenali
        return redirect()->route('dashboard');
    }
}

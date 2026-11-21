<?php

namespace App\Http\middlewares;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserExist
{
    public function handle(Request $request, Closure $next): Response
    {
        $email = $request->input('email');
        $phone = $request->input('phone');

        // Leave missing values to registration validation; this middleware checks duplicates.
        if (! $email && ! $phone) {
            return $next($request);
        }

        $userExists = User::query()
            ->where(function ($query) use ($email, $phone) {
                if ($email) {
                    $query->orWhere('email', $email);
                }

                if ($phone) {
                    $query->orWhere('phone', $phone);
                }
            })
            ->exists();

        if ($userExists) {
            return response()->json([
                'success' => false,
                'message' => 'A user with that email or phone already exists',
            ], 409);
        }

        return $next($request);
    }
}

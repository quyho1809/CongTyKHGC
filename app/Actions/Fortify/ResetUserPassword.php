<?php

namespace App\Actions\Fortify;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use App\Models\User;

class ResetUserPassword implements ResetsUserPasswords
{
    public function reset(User $user, array $input)
    {
        Validator::make($input, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        event(new PasswordReset($user));
    }
}

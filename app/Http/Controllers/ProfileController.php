<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profile', compact('user'));
    }

    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(User $user)
    {
        $validatedAttributes = request()->validate(
            [
                'username' => [
                    'required', 'string', 'max:255', 'alpha_dash',
                    Rule::unique('users')->ignore($user),
                ],

                'name' => ['required', 'string', 'max:255'],

                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'email' => [
                    'required', 'string', 'max:255',
                    Rule::unique('users')->ignore($user),
                ],

                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        if (request('avatar')) {

            $validatedAttributes['avatar'] = request('avatar')->store('avatars');
        }

        $user->update($validatedAttributes);

        return redirect(route('profile', $user->username))->with('success', 'Profile Updated successfully');;
    }

    // public function destroy(User $user)
    // {
    //     $user->delete();
    //     return redirect('home');
    // }
}

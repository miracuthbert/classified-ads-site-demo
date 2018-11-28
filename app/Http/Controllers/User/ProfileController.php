<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{


    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing user profile
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $roles= $request->user()->roles;

        return view('user.profile', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'username' => [
                'required',
                'string',
                'max:30',
                Rule::unique('users')->ignore($id)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
        ]);

        if (!Hash::check($request->input('password'), Auth::user()->password)) {
            return redirect()->back()
                ->withError('Invalid credentials! Profile update failed.');
        }

        //find user
        $user = $request->user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        if ($user->update()) {
            return redirect()->back()
                ->withSuccess('Profile updated successfully.');
        } else {
            return redirect()->back()
                ->withError('Profile update failed.');
        }

    }

}

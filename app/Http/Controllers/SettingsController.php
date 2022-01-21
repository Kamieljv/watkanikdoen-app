<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use TCG\Voyager\Http\Controllers\Controller;
use Validator;

class SettingsController extends Controller
{
    public function index($section = '')
    {
        if (empty($section)) {
            return redirect(route('wave.settings', 'profile'));
        }
        return view('theme::settings.index', compact('section'));
    }

    public function profilePut(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'sometimes|required|email|unique:users,email,' . Auth::user()->id,
            'username' => 'sometimes|required|unique:users,username,' . Auth::user()->id,
        ]);

        $authed_user = auth()->user();

        $authed_user->name = $request->name;
        $authed_user->email = $request->email;
        if ($request->avatar) {
            $authed_user->avatar = $this->saveAvatar($request->avatar, $authed_user->username);
        }
        $authed_user->save();

        return back()->with('success', __('settings.profile.update_success'));
    }

    public function securityPut(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:' . config('wave.auth.min_password_length'),
        ]);

        if ($validator->fails()) {
            return back()->with(['message' => $validator->errors()->first(), 'message_type' => 'danger']);
        }

        if (! Hash::check($request->current_password, $request->user()->password)) {
            return back()->with(['message' => 'Incorrect current password entered.', 'message_type' => 'danger']);
        }

        auth()->user()->forceFill([
            'password' => bcrypt($request->password),
        ])->save();

        return back()->with(['message' => 'Successfully updated your password.', 'message_type' => 'success']);
    }

    private function saveAvatar($avatar, $filename)
    {
        $path = 'avatars/' . $filename . '.png';
        Storage::disk(config('voyager.storage.disk'))->put($path, file_get_contents($avatar));
        return $path;
    }
}

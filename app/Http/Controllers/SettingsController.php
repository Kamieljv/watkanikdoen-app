<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use TCG\Voyager\Http\Controllers\Controller;
use Validator;

class SettingsController extends Controller
{
    public function index($section = '')
    {
        if (empty($section)) {
            return redirect(route('settings', 'profile'));
        }
        return view('settings.index', compact('section'));
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
            $authed_user->avatar = $this->saveAvatar($request->avatar, $authed_user->id);
        }
        $authed_user->save();

        return back()->with('success', __('settings.profile.update_success'));
    }

    public function securityPut(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:' . config('app.auth.min_password_length'),
        ])->validate();

        if (! Hash::check($request->current_password, $request->user()->password)) {
            $error = ValidationException::withMessages([
                'current_password' => [__('settings.security.incorrect_current_password')],
             ]);
            throw $error;
        }

        auth()->user()->forceFill([
            'password' => bcrypt($request->password),
        ])->save();

        return back()->with('success', __('settings.security.password_update_success'));
    }

    private function saveAvatar($avatar, $id)
    {
        $path = 'avatars/' . $id . '_' . uniqid() . '.png';
        Storage::disk(config('voyager.storage.disk'))->put($path, file_get_contents($avatar));
        return $path;
    }

    public function deleteAvatar($id) {
        if (auth()->user()->id !== (int) $id) {
            abort(403, 'Unauthorized action.');
        } else {
            if (Storage::disk(config('voyager.storage.disk'))->delete(auth()->user()->avatar)) {
                $user = auth()->user();
                $user->avatar = null;
                $user->save();
                $type = 'success';
                $message = __("settings.profile.avatar_delete_success");
            } else {
                $type = 'error';
                $message = __("settings.profile.avatar_delete_fail");
            }
            return view('partials.toast', compact('type', 'message'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
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

        if ($request->avatar) {
            // continue if avatar is base64
            if ($this->isBase64($request->avatar)) {
                $this->saveAvatar($request->avatar, $authed_user);
            }
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

    private function saveAvatar($avatar, $user)
    {
        $ext = '.' . explode('/', mime_content_type($avatar))[1];
        $path = 'avatars/' . md5($user->name . $user->email . microtime()) . $ext;
        // Store the image on the server
        Storage::disk('public')->put($path, file_get_contents($avatar));
        // Create entry in db
        Image::create([
            'path' => $path,
            'user_id' => $user->id,
        ]);
        return $path;
    }

    public function deleteAvatar($id)
    {
        if (auth()->user()->id !== (int) $id) {
            abort(403, 'Unauthorized action.');
        } else {
            if (Storage::disk('public')->delete(auth()->user()->linked_image->path)) {
                auth()->user()->linked_image()->delete();
                $type = 'success';
                $message = __("settings.profile.avatar_delete_success");
            } else {
                $type = 'error';
                $message = __("settings.profile.avatar_delete_fail");
            }
            return view('partials.toast', compact('type', 'message'));
        }
    }

    /**
     * Check if a string is base64 encoded
     *
     * @param string $string
     * @return bool
     */
    private function isBase64($string)
    {
        $decoded = base64_decode($string, true);
        // Check if the string is base64 encoded and if it can be re-encoded to the same value
        return $decoded !== false && base64_encode($decoded) === $string;
    }
}

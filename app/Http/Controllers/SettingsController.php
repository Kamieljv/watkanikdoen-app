<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use MWGuerra\FileManager\Models\FileSystemItem;
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
        ]);

        $authed_user = auth()->user();

        $authed_user->name = $request->name;
        if ($request->avatar) {
            // continue if avatar is base64
            $decodedAvatar = $this->isBase64($request->avatar);
            if ($decodedAvatar !== false) {
                $this->saveAvatar($decodedAvatar, $request->avatar, $authed_user);
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

    private function saveAvatar($imageData, $originalAvatar, $user)
    {
        // Save the decoded image data to storage and create a FileSystemItem
        $extension = explode('/', mime_content_type($originalAvatar))[1];
        $filePath = 'avatars/' . uniqid() . '.' . $extension;
        Storage::disk('public')->put($filePath, $imageData);

        // Get parent folder id
        $folderId = FileSystemItem::where('name', 'avatars')
            ->where('type', 'folder')
            ->first()->id ?? null;

        // Create entry in db
        $fileSystemItem = FileSystemItem::firstOrCreate([
            'storage_path' => $filePath,
        ], [
            'parent_id' => $folderId,
            'name' => basename($filePath),
            'type' => 'file',
            'file_type' => 'image',
            'size' => filesize(storage_path('app/public/' . $filePath)),
            'storage_path' => $filePath,
        ]);

        // Remove old avatar if exists
        if ($user->image()->first()) {
            Storage::disk('public')->delete($user->image()->first()->storage_path);
            $user->image()->detach();
        }
        // Attach new avatar
        $user->image()->attach($fileSystemItem->id);
        return $filePath;
    }

    public function deleteAvatar($id)
    {
        if (auth()->user()->id !== (int) $id) {
            abort(403, 'Unauthorized action.');
        } else {
            try {
                $image = auth()->user()->image()->firstOrFail();
                Storage::disk('public')->delete($image->storage_path);
                auth()->user()->image()->detach();
                $type = 'success';
                $message = __("settings.profile.avatar_delete_success");
            } catch (\Exception $e) {
                $type = 'error';
                $message = __("settings.profile.avatar_delete_fail");
                return view('partials.toast', compact('type', 'message'));
            }
            return view('partials.toast', compact('type', 'message'));
        }
    }

    /**
     * Check if a string is base64 encoded and return decoded data
     *
     * @param string $string
     * @return string|false Returns decoded data if valid base64, false otherwise
     */
    private function isBase64($string): bool|string
    {
        // Strip data URI prefix if present (e.g., "data:image/png;base64,")
        $base64String = preg_replace('#^data:image/\w+;base64,#i', '', $string);
        
        $decoded = base64_decode($base64String, true);
        // Check if the string is base64 encoded and if it can be re-encoded to the same value
        if ($decoded !== false && base64_encode($decoded) === $base64String) {
            return $decoded;
        }
        return false;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Delete unlinked images
     */
    public function deleteUnlinked() {
        Image::notHasLink()->delete();
        return redirect(route('voyager.images.index'));
    }
}

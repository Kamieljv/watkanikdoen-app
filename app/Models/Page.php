<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function link()
    {
        return url('p/' . $this->slug);
    }

    public function image()
    {
        // TODO: implement image from storage
        return '';
    }
}

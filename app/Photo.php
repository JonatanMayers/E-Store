<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{

    protected $fillable = ["name", "size"];


    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }


    public function getPhotoPath()
    {
        if ($this->product()->count()) {
            return $this->product->photoPath . $this->name;
        } elseif ($this->user()->count()) {
            return $this->user->photoPath . $this->name;
        } else {
            return "http://via.placeholder.com/70x70";
        }
    }

    public function getStoragePath()
    {
        if ($this->product()->count()) {
            return $this->product->storagePath . $this->name;
        } elseif ($this->user()->count()) {
            return $this->user->storagePath . $this->name;
        } else {
            return "http://via.placeholder.com/70x70";
        }
    }

    public function deletePhotoFile()
    {
        if (file_exists(public_path() . $this->getPhotoPath())) {
            Storage::delete($this->getStoragePath());
        }
    }


}

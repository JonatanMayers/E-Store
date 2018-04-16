<?php

namespace App\TraitsHelpers;

trait PhotoHelper
{

    public function checkForPhoto($request, $method = "")
    {
        if ($request->hasFile("image")) {

            $request->validate(["image" => "image|max:1999"], ["image" => "Photo file must be an image"]);

            $file = $request->file("image");
            $fileNameToStore = time() . "_" . $file->getClientOriginalName();
            $fileSize = round($file->getClientSize() / 1024, 1);

            if ($method == "update") {
                $this->deletePhoto();
            }

            $file->storeAs($this->storagePath, $fileNameToStore);
            $photo = Photo::create([
                "name" => $fileNameToStore,
                "size" => $fileSize
            ]);

            $this->photo_id = $photo->id;
        }
    }

    public function getPhotoPath()
    {
        if ($this->photo()->count()) {
            return $this->photoPath . $this->photo->name;
        } else {
            return "http://via.placeholder.com/50x50";
        }
    }

    public function getStoragePath()
    {
        return $this->storagePath . $this->photo->name;
    }

    public function deletePhoto()
    {
        if ($this->photo()->count()) {
            if (file_exists(public_path() . $this->getPhotoPath())) {
                Storage::delete($this->getStoragePath());
            }
            $this->photo->delete();
        }
    }


}
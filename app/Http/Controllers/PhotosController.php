<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Validator;

class PhotosController extends Controller
{

    public function index()
    {
        $photos = Photo::paginate(5);
        return view("admin.photos.index", compact("photos"));
    }

    public function destroy(Photo $photo)
    {
        $photo->deletePhotoFile();
        $photo->delete();

        return redirect()->route("photos.index")
            ->withSuccess("Photo and file deleted successfully !");
    }


    // Additional methods
    public function bulkDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "ids" => "required"
        ]);

        if ($validator->fails()) {
            return ["response" => $validator->messages(), "status" => false];
        } else {
            foreach ($request->ids as $id) {
                $photo = Photo::findOrFail($id);
                $photo->deletePhotoFile();
                $photo->delete();
            }
            return ["status" => true];
        }
    }


}

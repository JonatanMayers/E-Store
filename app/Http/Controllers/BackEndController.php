<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Condition;
use App\Product;
use App\Comment;
use App\User;
use App\Photo;

class BackEndController extends Controller
{

    public function index()
    {
        $totalCategories = Category::all()->count();
        $totalBrands = Brand::all()->count();
        $totalConditions = Condition::all()->count();
        $totalProducts = Product::all()->count();
        $totalPhotos = Photo::all()->count();
        $totalComments = Comment::all()->count();
        $totalUsers = User::all()->count();

        return view("admin.welcome",
            compact(
                "totalCategories", "totalBrands", "totalConditions", "totalProducts",
                "totalPhotos", "totalComments", "totalUsers"
            ));
    }


}

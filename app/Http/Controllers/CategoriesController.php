<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Validator;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(5);
        return view("admin.categories.index", compact("categories"));
    }

    public function create()
    {
        return view("admin.categories.create");
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if (Category::where("name", $request->name)->get()->count()) {
            return back()->withInfo("Category already exists ! Please choose another name !");
        }

        Category::create($data);

        return redirect()->route("categories.index")
            ->withSuccess("Category created successfully !");
    }

    public function edit(Category $category)
    {
        return view("admin.categories.edit", compact("category"));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if ($category->name != $request->name) {
            if (Category::where("name", $request->name)->get()->count()) {
                return back()->withInfo("Category already exists ! Please choose another name !");
            }
        }

        $category->update($data);

        return redirect()->route("categories.index")->withSuccess("Category updated successfully !");
    }

    public function destroy(Category $category)
    {
        foreach ($category->products as $product) {
            $product->deletePhoto();
        }

        $category->delete();

        return redirect()->route("categories.index")
            ->withSuccess("Category and all associated products deleted successfully !");
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
                $category = Category::findOrFail($id);
                foreach ($category->products as $product) {
                    $product->deletePhoto();
                }
                $category->delete();
            }
            return ["status" => true];
        }

    }

    public function products(Category $category)
    {
        $products = $category->products()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.categories.products", compact("category", "products"));
    }

    public function comments(Category $category)
    {
        $comments = $category->comments()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.categories.comments", compact("comments", "category"));
    }


}

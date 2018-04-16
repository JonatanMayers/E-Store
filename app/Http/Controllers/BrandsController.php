<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Validator;

class BrandsController extends Controller
{

    public function index()
    {
        $brands = Brand::paginate(5);
        return view("admin.brands.index", compact("brands"));
    }

    public function create()
    {
        return view("admin.brands.create");
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if (Brand::where("name", $request->name)->get()->count()) {
            return back()->withInfo("Brand already exists ! Please choose another name !");
        }

        Brand::create($data);

        return redirect()->route("brands.index")
            ->withSuccess("Brand created successfully !");
    }

    public function edit(Brand $brand)
    {
        return view("admin.brands.edit", compact("brand"));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if ($brand->name != $request->name) {
            if (Brand::where("name", $request->name)->get()->count()) {
                return back()->withInfo("Brand already exists ! Please choose another name !");
            }
        }

        $brand->update($data);

        return redirect()->route("brands.index")->withSuccess("Brand updated successfully !");
    }

    public function destroy(Brand $brand)
    {
        foreach ($brand->products as $product) {
            $product->deletePhoto();
        }

        $brand->delete();

        return redirect()->route("brands.index")
            ->withSuccess("Brand and all associated products deleted successfully !");
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
                $brand = Brand::findOrFail($id);
                foreach ($brand->products as $product) {
                    $product->deletePhoto();
                }
                $brand->delete();
            }
            return ["status" => true];
        }

    }

    public function products(Brand $brand)
    {
        $products = $brand->products()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.brands.products", compact("brand", "products"));
    }

    public function comments(Brand $brand)
    {
        $comments = $brand->comments()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.brands.comments", compact("comments", "brand"));
    }


}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Brand;
use App\Condition;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::orderBy("created_at", "desc")->paginate(5);
        return view("admin.products.index", compact("products"));
    }

    public function create()
    {
        $categories = Category::pluck("name", "id")->all();
        $brands = Brand::pluck("name", "id")->all();
        $conditions = Condition::pluck("name", "id")->all();

        if (!$categories) {
            return redirect()->route("categories.create")
                ->withInfo("Please create a category first!");
        }

        if (!$brands) {
            return redirect()->route("brands.create")
                ->withInfo("Please create a brand first!");
        }

        if (!$conditions) {
            return redirect()->route("conditions.create")
                ->withInfo("Please create a conditions first!");
        }

        return view("admin.products.create", compact("categories", "brands", "conditions"));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name"         => "required|max:255",
            "description"  => "required",
            "price"        => "required|integer",
            "quantity"     => "required|integer",
            "is_android"   => "required|integer|boolean",
            "is_threeD"    => "required|integer|boolean",
            "condition_id" => "required|integer",
            "category_id"  => "required|integer",
            "brand_id"     => "required|integer"
        ]);

        $data['user_id'] = auth()->id();
        $data['slug'] = str_slug($data['name']);

        $product = new Product($data);
        $product->checkForPhoto($request);
        $product->save();

        return redirect()->route("products.index")
            ->withSuccess("Product created successfully !");
    }

    public function edit(Product $product)
    {
        $categories = Category::pluck("name", "id")->all();
        $brands = Brand::pluck("name", "id")->all();
        $conditions = Condition::pluck("name", "id")->all();

        return view("admin.products.edit", compact("product", "categories", "brands", "conditions"));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validate($request, [
            "name"         => "required|max:255",
            "description"  => "required",
            "price"        => "required|integer",
            "quantity"     => "required|integer",
            "is_android"   => "required|integer|boolean",
            "is_threeD"    => "required|integer|boolean",
            "condition_id" => "required|integer",
            "category_id"  => "required|integer",
            "brand_id"     => "required|integer"
        ]);

        $data['slug'] = str_slug($data['name']);

        $product->checkForPhoto($request, "update");
        $product->update($data);

        return back()->withSuccess("Product updated successfully ");
    }

    public function destroy(Product $product)
    {
        $product->deletePhoto();
        $product->delete();

        return back()->withSuccess("Product deleted successfully !");
    }

    public function comments(Product $product)
    {
        $comments = $product->comments()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.products.comments", compact("comments", "product"));
    }


}

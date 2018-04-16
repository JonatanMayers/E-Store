<?php

namespace App\Http\Controllers;

use App\Condition;
use Illuminate\Http\Request;
use Validator;

class ConditionsController extends Controller
{

    public function index()
    {
        $conditions = Condition::paginate(5);
        return view("admin.conditions.index", compact("conditions"));
    }

    public function create()
    {
        return view("admin.conditions.create");
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if (Condition::where("name", $request->name)->get()->count()) {
            return back()->withInfo("Condition already exists ! Please choose another name !");
        }

        Condition::create($data);

        return redirect()->route("conditions.index")
            ->withSuccess("Condition created successfully !");
    }

    public function edit(Condition $condition)
    {
        return view("admin.conditions.edit", compact("condition"));
    }

    public function update(Request $request, Condition $condition)
    {
        $data = $this->validate($request, [
            "name" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if ($condition->name != $request->name) {
            if (Condition::where("name", $request->name)->get()->count()) {
                return back()->withInfo("Condition already exists ! Please choose another name !");
            }
        }

        $condition->update($data);

        return redirect()->route("conditions.index")->withSuccess("Condition updated successfully !");
    }

    public function destroy(Condition $condition)
    {
        foreach ($condition->products as $product) {
            $product->deletePhoto();
        }

        $condition->delete();

        return redirect()->route("conditions.index")
            ->withSuccess("Condition and all associated products deleted successfully !");
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
                $condition = Condition::findOrFail($id);
                foreach ($condition->products as $product) {
                    $product->deletePhoto();
                }
                $condition->delete();
            }
            return ["status" => true];
        }

    }

    public function products(Condition $condition)
    {
        $products = $condition->products()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.conditions.products", compact("condition", "products"));
    }

    public function comments(Condition $condition)
    {
        $comments = $condition->comments()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.conditions.comments", compact("comments", "condition"));
    }


}

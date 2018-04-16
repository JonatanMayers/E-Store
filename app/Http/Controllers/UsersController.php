<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware("admin", ["except" => ["profile", "profileUpdate", "products", "comments"]]);
    }

    public function index()
    {
        $users = User::paginate(5);
        return view("admin.users.index", compact("users"));
    }

    public function create()
    {
        return view("admin.users.create");
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "name"  => "required|max:255",
            "email" => "required|max:255"
        ]);

        $data["slug"] = str_slug($data["name"]);

        if (User::where("email", $request->email)->get()->count()) {
            return back()->withInfo("Email already taken. Please choose another !");
        }

        $data['password'] = bcrypt("123123");

        User::create($data);

        return redirect()->route("users.index")
            ->withSuccess("User created successfully !");
    }

    public function profile()
    {
        $user = auth()->user();
        return view("admin.users.profile", compact("user"));
    }

    public function profileUpdate(Request $request)
    {
        $data = $this->validate($request, [
            "name"  => "required|max:255",
            "email" => "required|max:255"
        ]);

        $user = auth()->user();

        if ($user->email != $request->email) {
            if (User::where("email", $request->email)->get()->count()) {
                return back()->withInfo("Email already taken. Please choose another !");
            }
        }

        if ($password = trim($request->password)) {
            if ($password === trim($request->password_confirmation)) {
                $data['password'] = bcrypt($password);
            } else {
                return back()->withInfo("Password confirmation failed !");
            }
        }

        $user->checkForPhoto($request, "update");

        $data["slug"] = str_slug($data["name"]);
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['about'] = $request->about;

        $user->update($data);

        return back()->withSuccess("Profile settings updated successfully !");
    }

    public function destroy(User $user)
    {
        if ($user->id == 1 || auth()->id() == $user->id) {
            return back()->withError("Access denied !");
        }

        foreach ($user->products as $product) {
            $product->deletePhoto();
        }

        $user->deletePhoto();
        $user->delete();

        return redirect()->route("users.index")
            ->withSuccess("User and all associated products deleted successfully");
    }


    // Additional methods
    public function makeAdmin(User $user)
    {
        $user->is_admin = 1;
        $user->save();

        return redirect()->route("users.index")
            ->withSuccess("Admin permissions added successfully !");
    }

    public function removeAdmin(User $user)
    {
        if (auth()->id() != $user->id && $user->id != 1) {
            $user->is_admin = 0;
            $user->save();
        } else {
            return back()->withError("Access denied !");
        }

        return redirect()->route("users.index")
            ->withSuccess("Admin permissions removed successfully !");
    }

    public function products(User $user)
    {
        $products = $user->products()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.users.products", compact("user", "products"));
    }

    public function comments(User $user)
    {
        $comments = $user->comments()->orderBy("created_at", "desc")->paginate(5);
        return view("admin.users.comments", compact("comments", "user"));
    }


}

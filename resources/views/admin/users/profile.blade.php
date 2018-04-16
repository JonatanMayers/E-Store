@extends("layouts.master")

@section("title")
    Profile | Edit
@endsection

@section("styles")
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Edit profile</h3>
        </div>

        <div class="card-body">

            {!! Form::model($user,["method"=>"PATCH","route"=>"users.profile.update","files"=>true]) !!}

            <div class="form-group">
                {!! Form::label("name","Name :") !!}
                {!! Form::text("name",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("email","Email :") !!}
                {!! Form::email("email",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("password","New Password :") !!}
                {!! Form::password("password",["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("password_confirmation","Repeat password :") !!}
                {!! Form::password("password_confirmation",["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("image","Avatar :") !!}
                {!! Form::file("image",["class"=>"form-control"]) !!}
            </div>

            <label for="image">
                <img src="{{ $user->getPhotoPath()}}" alt="No photo found" class="rounded-circle mb-3 mt-1" width="50">
            </label>

            <div class="form-group">
                {!! Form::label("facebook","Facebook :") !!}
                {!! Form::text("facebook",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("youtube","Youtube :") !!}
                {!! Form::text("youtube",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("about","About :") !!}
                {!! Form::textarea("about",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit("Update",["class"=>"btn btn-success"]) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection

@section("scripts")
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
@endsection
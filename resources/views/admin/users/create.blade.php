@extends("layouts.master")

@section("title")
    User | Create
@endsection


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Create user</h3>
        </div>

        <div class="card-body">

            {!! Form::open(["method"=>"POST","route"=>"users.store"]) !!}

            <div class="form-group">
                {!! Form::label("name","Name :") !!}
                {!! Form::text("name",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("email","Email :") !!}
                {!! Form::email("email",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit("Create",["class"=>"btn btn-success"]) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection

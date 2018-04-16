@extends("layouts.master")

@section("title","Category | Create")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Create category</h3>
        </div>

        <div class="card-body">

            {!! Form::open(["method"=>"POST","route"=>"categories.store"]) !!}

            <div class="form-group">
                {!! Form::label("name","Name :") !!}
                {!! Form::text("name",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit("Create",["class"=>"btn btn-success"]) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>


@endsection
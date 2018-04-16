@extends("layouts.master")

@section("title","Brand | Create")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Create band</h3>
        </div>

        <div class="card-body">

            {!! Form::open(["method"=>"POST","route"=>"brands.store"]) !!}

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
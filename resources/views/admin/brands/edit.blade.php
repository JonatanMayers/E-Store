@extends("layouts.master")

@section("title","Brand | Edit")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Edit brand</h3>
        </div>

        <div class="card-body">

            {!! Form::model($brand,["method"=>"PATCH","route"=>["brands.update",$brand->slug]]) !!}

            <div class="form-group">
                {!! Form::label("name","Name :") !!}
                {!! Form::text("name",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit("Update",["class"=>"btn btn-success"]) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection
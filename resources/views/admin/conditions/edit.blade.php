@extends("layouts.master")

@section("title","Condition | Edit")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Edit condition</h3>
        </div>

        <div class="card-body">

            {!! Form::model($condition,["method"=>"PATCH","route"=>["conditions.update",$condition->slug]]) !!}

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
@extends("layouts.master")

@section("title")
    Settings | Edit
@endsection


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Edit settings</h3>
        </div>

        <div class="card-body">

            {!! Form::model($setting,["method"=>"PATCH","route"=>"settings.update"]) !!}

            <div class="form-group">
                {!! Form::label("site_name","Site name :") !!}
                {!! Form::text("site_name",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("contact_number","Contact number :") !!}
                {!! Form::text("contact_number",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("contact_email","Contact email :") !!}
                {!! Form::email("contact_email",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("address","Address :") !!}
                {!! Form::text("address",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit("Update",["class"=>"btn btn-success"]) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection

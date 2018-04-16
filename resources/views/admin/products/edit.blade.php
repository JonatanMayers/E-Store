@extends("layouts.master")

@section("title","Product | Edit")

@section("styles")
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
@endsection

@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Edit product</h3>
        </div>

        <div class="card-body">

            {!! Form::model($product,["method"=>"PATCH","route"=>["products.update",$product->slug],"files"=>true]) !!}

            <div class="form-group">
                {!! Form::label("name","Name :") !!}
                {!! Form::text("name",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("category_id","Category :") !!}
                {!! Form::select("category_id",$categories,null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("brand_id","Brand :") !!}
                {!! Form::select("brand_id",$brands,null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("description","Description :") !!}
                {!! Form::textarea("description",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("image","Photo :") !!}
                {!! Form::file("image",["class"=>"form-control"]) !!}
            </div>

            <label for="image">
                <img src="{{ $product->getPhotoPath() }}" alt="{{ $product->slug }}" width="200" class="rounded">
            </label>

            <div class="form-group">
                {!! Form::label("condition_id","Condition :") !!}
                {!! Form::select("condition_id",$conditions,null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("is_android","Android :") !!}
                {!! Form::select("is_android",["No","Yes"],null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("is_threeD","3D :") !!}
                {!! Form::select("is_threeD",["No","Yes"],null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("price","Price :") !!}
                {!! Form::number("price",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("quantity","Quantity :") !!}
                {!! Form::number("quantity",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit("Update",["class"=>"btn btn-primary"]) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>


@endsection

@section("scripts")
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
@endsection
<div class="list-group">

    <?php
    $currentUrl = Request::path();
    $urlArr = explode("/", $currentUrl);
    ?>

    <a class="list-group-item {{ $currentUrl == "/" ? "active" : "" }}" href="{{ route("home") }}">
        Home
    </a>

    @if(count($categories))
        @foreach($categories as $category)
            <?php
            $chosenCategory = count($urlArr) >= 2 ? $urlArr[1] : "";
            ?>
            <a class="list-group-item {{ $chosenCategory == $category->slug ? "active" : "" }}"
               href="{{ route("category.products",$category->slug) }}">
                {{ $category->name }}
            </a>
        @endforeach
    @else
        <h3 class="text-center">No category found</h3>
    @endif

</div>

<?php
$currentRoute = Route::currentRouteName();
?>

@if(
    $currentRoute == "home" ||
    $currentRoute == "user.products" ||
    $currentRoute == "category.products" ||
    $currentRoute == "brand.products" ||
    $currentRoute == "condition.products" ||
    $currentRoute == "android.products" ||
    $currentRoute == "threeD.products"
)

    {!! Form::open(["method"=>"POST","id"=>"filterForm"]) !!}

    <h4 class="mt-4">Filters :</h4>

    <?php
    $priceArr = ["Choose price", "0-99 &euro;", "100-499 &euro;", "500-999 &euro;", "1000-9999 &euro;"];
    ?>

    <div class="form-group mt-4">
        {!! Form::label("price","Price :",["class"=>"lead"]) !!}
        {!! Form::select("price",$priceArr,null,["class"=>"form-control"])!!}
    </div>

    <label class="lead mt-2"> Brands </label>
    <div class="form-group">
        @foreach($brands as $brand)
            <label class="mr-2">
                {!! Form::checkbox("brands[]",$brand->id,false,["class"=>"brandFilter"]) !!} {{ $brand->name }}
            </label>
        @endforeach
    </div>

    <label class="lead mt-2"> Android OS</label>
    <div class="form-group">
        <label class="mr-2"> {!! Form::checkbox("android[]",1,false,["class"=>"androidFilter"]) !!} Yes </label>
        <label class="mr-2"> {!! Form::checkbox("android[]",0,false,["class"=>"androidFilter"]) !!} No </label>
    </div>

    <label class="lead mt-2"> 3D </label>
    <div class="form-group">
        <label class="mr-2"> {!! Form::checkbox("threeD[]",1,false,["class"=>"threeDFilter"]) !!} Yes </label>
        <label class="mr-2"> {!! Form::checkbox("threeD[]",0,false,["class"=>"threeDFilter"]) !!} No </label>
    </div>

    <label class="lead mt-2"> Condition </label>
    <div class="form-group">
        @foreach($conditions as $condition)
            <label class="mr-2">
                {!! Form::checkbox("conditions[]",$condition->id,false,["class"=>"conditionFilter"]) !!} {{ $condition->name }}
            </label>
        @endforeach
    </div>

@endif

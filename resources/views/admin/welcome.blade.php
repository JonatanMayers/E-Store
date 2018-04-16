@extends("layouts.master")

@section("title","Admin | Index")


@section("content")

    <h1 class="mb-5">Welcome {{ auth()->user()->name }} !
        <hr>
        <small>How are you today ?</small>
    </h1>

    <div class="row mt-4">

        <div class="col-lg">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Total categories
                </div>
                <div class="card-body">
                    <h1><a href="{{ route("categories.index") }}">
                            {{ $totalCategories }}
                        </a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Total brands
                </div>
                <div class="card-body">
                    <h1><a href="{{ route("brands.index") }}">
                            {{ $totalBrands }}
                        </a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Total conditions
                </div>
                <div class="card-body">
                    <h1><a href="{{ route("conditions.index") }}">
                            {{ $totalConditions }}
                        </a>
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-lg">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Total products
                </div>
                <div class="card-body">
                    <h1><a href="{{ route("products.index") }}">
                            {{ $totalProducts }}
                        </a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Total photos
                </div>
                <div class="card-body">
                    <h1>
                        <a href="{{ route("photos.index") }}">
                            {{ $totalPhotos }}
                        </a>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card text-center">
                <div class="card-header bg-info text-white">
                    Total comments
                </div>
                <div class="card-body">
                    <h1>
                        <a href="{{ route("comments.index") }}">
                            {{ $totalComments }}
                        </a>
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        @if(auth()->user()->is_admin)
            <div class="col-lg">
                <div class="card text-center">
                    <div class="card-header bg-info text-white">
                        Total users
                    </div>
                    <div class="card-body">
                        <h1>
                            <a href="{{ route("users.index") }}">
                                {{ $totalUsers }}
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        @endif

    </div>



@endsection
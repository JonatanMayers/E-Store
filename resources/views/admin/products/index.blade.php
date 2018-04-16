@extends("layouts.master")

@section("title","Products | Index")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>All products</h3>
        </div>

        <div class="card-body">
            @if(count($products))
                @include("admin.products.template")
            @else
                <h3 class="text-center">No products found</h3>
            @endif
        </div>

        <div class="mx-auto">
            {{ $products->links() }}
        </div>

    </div>


@endsection
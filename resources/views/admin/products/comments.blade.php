@extends("layouts.master")

@section("title")
    Product | comments
@endsection


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Product | {{ str_limit($product->name,45) }} | comments</h3>
        </div>

        <div class="card-body">

            @if(count($comments))
                @include("admin.comments.template")
            @else
                <h3 class="text-center">No product's comments found</h3>
            @endif

        </div>

        <div class="mx-auto">
            {{ $comments->links() }}
        </div>

    </div>

@endsection

@section("scripts")
    @include("inc.bulkActions")
@endsection
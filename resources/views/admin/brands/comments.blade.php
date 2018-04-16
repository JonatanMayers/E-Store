@extends("layouts.master")

@section("title")
    Brand | comments
@endsection


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>Brand | {{ $brand->name }} | comments</h3>
        </div>

        <div class="card-body">

            @if(count($comments))
                @include("admin.comments.template")
            @else
                <h3 class="text-center">No brand's comments found</h3>
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
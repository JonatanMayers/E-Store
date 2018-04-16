@extends("layouts.master")

@section("title","Categories | Index")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>All categories</h3>
        </div>

        <div class="card-body">

            @if(count($categories))

                @include("inc.bulkDeleteForm")

                <table class="table table-hover">
                    <tr>
                        <th>{!! Form::checkbox("bulk",null,null,["id"=>"checkAll"]) !!}</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Different products</th>
                        <th>Products quantity</th>
                        <th>Total comments</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {!! Form::checkbox("bulk",$category->id,null,["class"=>"checkbox"]) !!}
                            </td>
                            <td>
                                {{ $category->id }}
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route("categories.products",$category->slug) }}">
                                    View products <strong>({{ $category->products()->count() }})</strong>
                                </a>
                            </td>
                            <td>
                                {{ $category->getProductQty() }}
                            </td>
                            <td>
                                <a href="{{ route("categories.comments",$category->slug) }}">
                                    View comments <strong>({{ $category->comments()->count() }})</strong>
                                </a>
                            </td>
                            <td>
                                {{ $category->created_at->toFormattedDateString() }}
                            </td>
                            <td>
                                {{ $category->updated_at->diffForHumans() }}
                            </td>
                            <td>
                                <a href="{{ route("categories.edit",$category->slug) }}" class="btn btn-info">
                                    Edit
                                </a>
                            </td>
                            <td>
                                {!! Form::open(["method"=>"DELETE","route"=>["categories.destroy",$category->slug]]) !!}
                                    {!! Form::button("Delete",
                                    ["class"=>"btn btn-danger deleteButton","data-toggle"=>"modal","data-target"=>"#deleteModal"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-center">No categories found</h3>
            @endif

        </div>

        <div class="mx-auto">
            {{ $categories->links() }}
        </div>

    </div>

@endsection

@section("scripts")
    @include("inc.bulkActions")
@endsection
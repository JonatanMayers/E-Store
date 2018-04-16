@extends("layouts.master")

@section("title","Brands | Index")


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>All brands</h3>
        </div>

        <div class="card-body">

            @if(count($brands))

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
                    @foreach($brands as $brand)
                        <tr>
                            <td>
                                {!! Form::checkbox("bulk",$brand->id,null,["class"=>"checkbox"]) !!}
                            </td>
                            <td>
                                {{ $brand->id }}
                            </td>
                            <td>
                                {{ $brand->name }}
                            </td>
                            <td>
                                <a href="{{ route("brands.products",$brand->slug) }}">
                                    View products <strong>({{ $brand->products()->count() }})</strong>
                                </a>
                            </td>
                            <td>
                                {{ $brand->getProductQty() }}
                            </td>
                            <td>
                                <a href="{{ route("brands.comments",$brand->slug) }}">
                                    View comments <strong>({{ $brand->comments()->count() }})</strong>
                                </a>
                            </td>
                            <td>
                                {{ $brand->created_at->toFormattedDateString() }}
                            </td>
                            <td>
                                {{ $brand->updated_at->diffForHumans() }}
                            </td>
                            <td>
                                <a href="{{ route("brands.edit",$brand->slug) }}" class="btn btn-info">
                                    Edit
                                </a>
                            </td>
                            <td>
                                {!! Form::open(["method"=>"DELETE","route"=>["brands.destroy",$brand->slug]]) !!}
                                {!! Form::button("Delete",
                                ["class"=>"btn btn-danger deleteButton","data-toggle"=>"modal","data-target"=>"#deleteModal"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-center">No brands found</h3>
            @endif

        </div>

        <div class="mx-auto">
            {{ $brands->links() }}
        </div>

    </div>

@endsection

@section("scripts")
    @include("inc.bulkActions")
@endsection
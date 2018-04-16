@extends("layouts.master")

@section("title")
    Photos | Index
@endsection


@section("content")

    <div class="card">

        <div class="card-header">
            <h3>All photos</h3>
        </div>

        <div class="card-body">

            @if(count($photos))

                @include("inc.bulkDeleteForm")

                <table class="table table-hover">
                    <tr>
                        <th>{!! Form::checkbox("bulk",null,null,["id"=>"checkAll"]) !!}</th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($photos as $photo)
                        <tr>
                            <td>
                                {!! Form::checkbox("bulk",$photo->id,null,["class"=>"checkbox"]) !!}
                            </td>
                            <td>
                                {{ $photo->id }}
                            </td>
                            <td>
                                <img src="{{ $photo->getPhotoPath() }}" alt="{{ $photo->name }}" width="70" class="rounded">
                            </td>
                            <td>
                                {{ $photo->size . " KB" }}
                            </td>
                            <td>
                                {{ $photo->created_at->toFormattedDateString() }}
                            </td>
                            <td>
                                {{ $photo->updated_at->diffForHumans() }}
                            </td>
                            <td>
                                {!! Form::open(["method"=>"DELETE","route"=>["photos.destroy",$photo->id]]) !!}
                                {!! Form::button("Delete",
                                ["class"=>"btn btn-danger deleteButton","data-toggle"=>"modal","data-target"=>"#deleteModal"]) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h3 class="text-center">No photos found</h3>
            @endif

        </div>

        <div class="mx-auto">
            {{ $photos->links() }}
        </div>

    </div>

@endsection

@section("scripts")
    @include("inc.bulkActions")
@endsection
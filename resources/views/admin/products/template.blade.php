<table class="table table-hover">
    <tr>
        <th>Id</th>
        <th>Image</th>
        <th>User</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Condition</th>
        <th>Total comments</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    @foreach($products as $product)
        <tr>
            <td>
                {{ $product->id }}
            </td>
            <td>
                <img src="{{ $product->getPhotoPath() }}" alt="{{ $product->slug }}" width="50" class="rounded">
            </td>
            <td>
                <a href="{{ route("users.products",$product->user->slug) }}">
                    {{ $product->user->name }}
                </a>
            </td>
            <td>
                <a href="{{ route("categories.products",$product->category->slug) }}">
                    {{ $product->category->name }}
                </a>
            </td>
            <td>
                <a href="{{ route("brands.products",$product->brand->slug) }}">
                    {{ $product->brand->name }}
                </a>
            </td>
            <td>
                <a href="{{ route("conditions.products",$product->condition->slug) }}">
                    {{ $product->condition->name }}
                </a>
            </td>
            <td>
                <a href="{{ route("products.comments",$product->slug) }}">
                    View comments <strong>({{ $product->comments()->count() }})</strong>
                </a>
            </td>
            <td>
                {{ str_limit($product->name,25) }}
            </td>
            <td>
                {{ $product->quantity }}
            </td>
            <td>
                {{ $product->created_at->toFormattedDateString() }}
            </td>
            <td>
                {{ $product->updated_at->diffForHumans()  }}
            </td>
            <td>
                <a href="{{ route("products.edit",$product->slug) }}" class="btn btn-info">
                    Edit
                </a>
            </td>
            <td>
                {!! Form::open(["method"=>"DELETE","route"=>["products.destroy",$product->slug]]) !!}
                {!! Form::button("Delete",
                ["class"=>"btn btn-danger deleteButton","data-toggle"=>"modal","data-target"=>"#deleteModal"]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>

@include("inc.deleteModal")

{!! Form::open() !!}
<div class="row">
    <div class="form-group col-sm-3">
        {!! Form::select("status",[""=>"Bulk delete"],null,["class"=>"form-control"]) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::button("Delete",
        ["class"=>"btn btn-success","data-toggle"=>"modal","data-target"=>"#deleteModal","id"=>"bulkDeleteButton"]) !!}
    </div>
</div>
{!! Form::close() !!}
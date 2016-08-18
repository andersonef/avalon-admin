<!--BOX CONTENT -->
<div class="box-body">
    {!! csrf_field() !!}


    <div class="form-group">
        <label class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Parameters.create.lblCategory')</label>
        <div class="col-md-10 col-sm-12">
            <select class="select form-control" name="categoryId">
                @foreach(Avalon\Category::getFirstOnes()->get() as $category)
                    <option value="{!! $category->id !!}">{!! $category->categoryName !!}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="form-group">
        <label class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Parameters.create.lblName')</label>
        <div class="col-md-10 col-sm-12">
            <input type="text" class="form-control" name="id" value="{!! old('id', (empty($parameter)) ? '' : $parameter->id) !!}">
        </div>
    </div>


    <div class="form-group">
        <label class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Parameters.create.lblDescription')</label>
        <div class="col-md-10 col-sm-12">
            <input type="text" class="form-control" name="parameterDescription" value="{!! old('parameterDescription', (empty($parameter)) ? '' : $parameter->parameterDescription) !!}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Parameters.create.lblContent')</label>
        <div class="col-md-10 col-sm-12">
            <textarea class="form-control" id="parameterValue" name="parameterValue">{!! old('parameterValue', (empty($parameter)) ? '' : $parameter->parameterValue) !!}</textarea>
        </div>
    </div>
</div>

<!--BOX FOOTER -->
<div class="box-footer text-right">
    <button class="btn btn-primary">@lang('AvalonAdmin::Layout/Admin/Config.btnSave')</button>
</div>

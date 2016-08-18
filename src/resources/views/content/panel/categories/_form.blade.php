<!--BOX CONTENT -->
<div class="box-body">
    {!! csrf_field() !!}


    <div class="form-group">
        <label class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Categories.create.lblName')</label>
        <div class="col-md-10 col-sm-12">
            <input type="text" class="form-control" name="categoryName" value="{!! old('categoryName', (empty($category)) ? '' : $category->categoryName) !!}">
        </div>
    </div>

    <div class="form-group">
        <label for="categoryInternal" class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Categories.create.lblInternal')</label>
        <div class="col-md-10 col-sm-12">
            <input type="checkbox" name="categoryInternal" value="1" {!! (old('categoryInternal', (empty($category)) ? '' : $category->categoryInternal)) ? 'checked' : '' !!} class="checkbox" id="categoryInternal">
        </div>
    </div>


    <div class="form-group">
        <label class="col-md-2 col-sm-12">@lang('AvalonAdmin::Content/Panel/Categories.create.lblDescription')</label>
        <div class="col-md-10 col-sm-12">
            <textarea class="form-control" name="categoryDescription">{!! old('categoryDescription', (empty($category)) ? '' : $category->categoryDescription) !!}</textarea>
        </div>
    </div>
</div>

<!--BOX FOOTER -->
<div class="box-footer text-right">
    <button class="btn btn-primary">@lang('AvalonAdmin::Layout/Admin/Config.btnSave')</button>
</div>

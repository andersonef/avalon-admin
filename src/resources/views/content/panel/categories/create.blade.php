@extends('AvalonAdmin::layout.admin.dashboard.index')

@section('title')
    <title>@lang('AvalonAdmin::Content/Panel/Categories.create.title')</title>
@endsection

@section('content-header')
    <section class="content-header">
        <h1>
             <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('avalon.admin.panel.dashboard.index') !!}"><i class="fa fa-dashboard"></i> @lang('AvalonAdmin::Content/Panel/Dashboard.name')</a></li>
            <li><a href="{!! route('avalon.admin.panel.categories.index') !!}"><i class="fa fa-dashboard"></i> @lang('AvalonAdmin::Content/Panel/Categories.name')</a></li>
            <li class="active">@lang('AvalonAdmin::Content/Panel/Categories.create.name')</li>
        </ol>
    </section>
@endsection


@section('content')

        <!-- BOX -->
        <div class="box box-primary">
            <!--box header-->
            <div class="box-header with-border">
                <h4>@lang('AvalonAdmin::Content/Panel/Categories.name')</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button disabled type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>

            <form action="{!! route('avalon.admin.panel.categories.store') !!}" method="post" class="form form-horizontal">
                <!--BOX CONTENT -->
                @include('AvalonAdmin::content/panel/categories/_form')
            </form>
        </div>
        <!-- FIM DA BOX-->

@endsection

@section('javascript')
    <script type="text/javascript">
        $(".sidebar-menu .categories").addClass('active');
    </script>
@endsection
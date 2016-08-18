@extends('AvalonAdmin::layout.admin.dashboard.index')

@section('title')
    <title>@lang('AvalonAdmin::Content/Panel/Parameters.index.title')</title>
@endsection

@section('content-header')
    <section class="content-header">
        <h1>
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('avalon.admin.panel.dashboard.index') !!}"><i class="fa fa-dashboard"></i> @lang('AvalonAdmin::Content/Panel/Dashboard.name')</a></li>
            <li class="active">@lang('AvalonAdmin::Content/Panel/Parameters.name')</li>
        </ol>
    </section>
@endsection


@section('content')

        <div class="box box-primary">
            <!--box header-->
            <div class="box-header with-border">
                <h4>@lang('AvalonAdmin::Content/Panel/Parameters.name')</h4>
                <div class="box-tools pull-right">
                    <!--<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
                    <a href="{!! route('avalon.admin.panel.parameters.create') !!}" class="btn btn-primary">@lang('AvalonAdmin::Content/Panel/Parameters.btnNew')</a>
                </div>
            </div>


            <!--BOX CONTENT -->
            <div class="box-body">
                <p>@lang('AvalonAdmin::Content/Panel/Parameters.index.info')</p>
                @foreach($items = Avalon\Parameter::getLastOnes()->paginate(25) as $parameter)
                    <div class="col-md-3 col-sm-12">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h4 class="box-title">{!! $parameter->id !!} ({!! $parameter->parameterDescription !!})</h4>
                                <div class="box-tools pull-right">
                                    <a href="{!! route('avalon.admin.panel.parameters.edit', $parameter->id) !!}" type="button" class="btn btn-box-tool"><i class="fa fa-pencil"></i>
                                    </a>
                                    <a data-method="DELETE" data-token="{!! csrf_token() !!}" data-confirm="Tem certeza que deseja apagar esse parâmetro?" href="{!! route('avalon.admin.panel.parameters.destroy',$parameter->id) !!}" type="button" class="btn btn-box-tool"><i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body"><h5>{!! $parameter->parameterValue !!}</h5></div>
                            <div class="box-footer">
                                @lang('AvalonAdmin::Content/Panel/Parameters.index.lblUsage', ['id' => $parameter->id])
                            </div>
                        </div>
                    </div>
                @endforeach

                {!! $items->render() !!}
            </div>

        </div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(".sidebar-menu .parameters").addClass('active');
    </script>
@endsection
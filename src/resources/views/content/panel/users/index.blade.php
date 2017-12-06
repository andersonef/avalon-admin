@extends('AvalonAdmin::layout.admin.dashboard.index')

@section('title')
    <title>@lang('AvalonAdmin::Content/Panel/Users.index.title')</title>
@endsection

@section('content-header')
    <section class="content-header">
        <h1>
            User Management
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('avalon.admin.panel.dashboard.index') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <h1>Aqui vem o conteúdo principal</h1>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(".sidebar-menu .users").addClass('active');
    </script>
@endsection
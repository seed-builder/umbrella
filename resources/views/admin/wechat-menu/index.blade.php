@extends('admin.layouts.main')
@section('styles')
    @include('admin.layouts.datatable-css')
@endsection

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>top module
                    <small>users</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">users</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-docs font-dark"></i>
                            <span class="caption-subject bold uppercase font-dark">微信菜单设置</span>

                        </div>

                    </div>
                    <div class="portlet-body">
                        <div class="col-md-6">
                            @foreach($menus as $menu)
                                <div class="btn-group dropup">
                                    <button type="button" class="btn btn-default">{{$menu->name}}</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                        <i class="fa fa-angle-up"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        @php
                                            $child_count = empty($menu->sub_button) ? 0 : count($menu->sub_button->list)
                                        @endphp
                                        @if(!empty($menu->sub_button->list))
                                            @foreach($menu->sub_button->list as $button)
                                                <li>
                                                    <a href="javascript:;"> {{$button->name}} </a>
                                                </li>
                                            @endforeach
                                        @endif
                                        @if($child_count<3)
                                            <li>
                                                <a href="javascript:;" class="add-child" data-value="{{$menu->id}}"> + </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <div class="portlet-body form">
                                <form class="form-horizontal" id="form-id" action="/admin/wechat-menu/store">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">菜单名称</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="sn">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-actions right">
                                        <button type="button" class="btn default back-link">返回</button>
                                        <button type="button" class="btn green form-submit">提交</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>


@endsection
@section('scripts')

@endsection
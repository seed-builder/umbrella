@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>equipment_logs详情</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">equipment_logs详情</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">equipment_logs详情</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            
                            
                            <div class="row">
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">api_name:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->api_name}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">code:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->code}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">content:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->content}} </p>
                                            </div>
                                        </div>
                                    </div>

                                                                        </div>
                                    <div class="row">
                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">created_at:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->created_at}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">creator_id:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->creator_id}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">deleted_at:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->deleted_at}} </p>
                                            </div>
                                        </div>
                                    </div>

                                                                        </div>
                                    <div class="row">
                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">equipment_id:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->equipment_id}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">id:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->id}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">modifier_id:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->modifier_id}} </p>
                                            </div>
                                        </div>
                                    </div>

                                                                        </div>
                                    <div class="row">
                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">site_id:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->site_id}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">type:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->type}} </p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">updated_at:</label>
                                            <div class="col-md-9">
                                                <p class="form-control-static"> {{$entity->updated_at}} </p>
                                            </div>
                                        </div>
                                    </div>

                                                                        </div>
                                    <div class="row">
                                    
                                                            </div>


                        </div>

                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')<script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
</script>

@endsection
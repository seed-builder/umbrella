@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>equipments新增</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">equipments新增</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">equipments新增</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="/admin/equipment/store">
                        {{ csrf_field() }}                        <div class="form-body">
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">capacity</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="capacity">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">created_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="created_at">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">creator_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="creator_id">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">deleted_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="deleted_at">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">have</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="have">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="id">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ip</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="ip">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">modifier_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="modifier_id">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">site_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="site_id">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">sn</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="sn">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">status</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="status">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">type</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="type">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">updated_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="updated_at">
                                    </div>
                                </div>
                            </div>
                                                    </div>
                        <div class="row"></div>


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


@endsection
@section('scripts')<script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
</script>

@endsection
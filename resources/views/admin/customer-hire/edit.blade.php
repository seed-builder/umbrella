@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>customer_hires编辑</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/admin/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">customer_hires</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">customer_hires编辑</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="/admin/customerhire/edit/{{$entity->id}}">
                        {{ csrf_field() }}                        <div class="form-body">
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">created_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="created_at" value="{{$entity->created_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">creator_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="creator_id" value="{{$entity->creator_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">customer_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="customer_id" value="{{$entity->customer_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">deleted_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="deleted_at" value="{{$entity->deleted_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">expired_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="expired_at" value="{{$entity->expired_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">expire_day</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="expire_day" value="{{$entity->expire_day}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_amt</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_amt" value="{{$entity->hire_amt}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_at" value="{{$entity->hire_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_day</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_day" value="{{$entity->hire_day}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_equipment_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_equipment_id" value="{{$entity->hire_equipment_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_site_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_site_id" value="{{$entity->hire_site_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="id" value="{{$entity->id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">margin_amt</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="margin_amt" value="{{$entity->margin_amt}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">modifier_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="modifier_id" value="{{$entity->modifier_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">return_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="return_at" value="{{$entity->return_at}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">return_equipment_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="return_equipment_id" value="{{$entity->return_equipment_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">return_site_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="return_site_id" value="{{$entity->return_site_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">status</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="status" value="{{$entity->status}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">umbrella_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="umbrella_id" value="{{$entity->umbrella_id}}">
                                    </div>
                                </div>
                            </div>
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">updated_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="updated_at" value="{{$entity->updated_at}}">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <hr>
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
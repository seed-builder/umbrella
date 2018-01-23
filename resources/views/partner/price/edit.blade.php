@extends('partner.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>prices编辑</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/partner/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">prices</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">prices编辑</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="/partner/price/edit/{{$entity->id}}">
                        {{ csrf_field() }}                        <div class="form-body">
                            <div class="row">
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">begin</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="begin" value="{{$entity->begin}}">
                                    </div>
                                </div>
                            </div>
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">created_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="created_at" value="{{$entity->created_at}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
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
                                    <label class="col-md-3 control-label">delay_seconds</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="delay_seconds" value="{{$entity->delay_seconds}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
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
                                    <label class="col-md-3 control-label">deposit_cash</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="deposit_cash" value="{{$entity->deposit_cash}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">end</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="end" value="{{$entity->end}}">
                                    </div>
                                </div>
                            </div>
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">equipment_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="equipment_id" value="{{$entity->equipment_id}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_expire_hours</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_expire_hours" value="{{$entity->hire_expire_hours}}">
                                    </div>
                                </div>
                            </div>
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_free_hours</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_free_hours" value="{{$entity->hire_free_hours}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_price</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_price" value="{{$entity->hire_price}}">
                                    </div>
                                </div>
                            </div>
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">hire_unit_hours</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="hire_unit_hours" value="{{$entity->hire_unit_hours}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
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
                                    <label class="col-md-3 control-label">is_default</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="is_default" value="{{$entity->is_default}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
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
                                    <label class="col-md-3 control-label">name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{$entity->name}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
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
                                    <label class="col-md-3 control-label">updated_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="updated_at" value="{{$entity->updated_at}}">
                                    </div>
                                </div>
                            </div>
                                                                    </div>
                                    <div class="row">
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
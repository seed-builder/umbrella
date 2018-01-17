@extends('partner.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>umbrellas新增</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">umbrellas新增</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="/partner/umbrella/create">
                        {{ csrf_field() }}                        <div class="form-body">
                            <div class="row">
                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">birth_equipment_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="birth_equipment_id">
                                    </div>
                                </div>
                            </div>
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">birth_site_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="birth_site_id">
                                    </div>
                                </div>
                            </div>
                                                                </div>
                                <div class="row">
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
                                                                </div>
                                <div class="row">
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
                                    <label class="col-md-3 control-label">equipment_channel_num</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="equipment_channel_num">
                                    </div>
                                </div>
                            </div>
                                                                </div>
                                <div class="row">
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">equipment_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="equipment_id">
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
                                                                </div>
                                <div class="row">
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
                                    <label class="col-md-3 control-label">number</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="number">
                                    </div>
                                </div>
                            </div>
                                                                </div>
                                <div class="row">
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">price_id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="price_id">
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
                                                                </div>
                                <div class="row">
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
                                                                </div>
                                <div class="row">
                                                                                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">updated_at</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="updated_at">
                                    </div>
                                </div>
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


@endsection
@section('scripts')<script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
</script>

@endsection
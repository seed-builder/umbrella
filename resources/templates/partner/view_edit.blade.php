<?php echo "@extends('partner.layouts.main')"; ?>

<?php echo  "@section('styles')" ; ?>


<?php echo  "@endsection" ; ?>


<?php echo  "@section('content')" ; ?>

<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>{{$topModule or 'top module'}}
                <small>{{$table}}编辑</small>
            </h1>
        </div>
    </div>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="/partner/">首页</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span id="breadcrumb" class="active">{{$table}}</span>
        </li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered" id="blockui-id">
                <div id="alert-id"></div>
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{$table}}编辑</span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal" id="form-id" action="<?php echo '/partner/'.snake_case($model,'').'/edit/{{$entity->id}}' ?>">
                        <?php echo '{{ csrf_field() }}'?>
                        <div class="form-body">
                            <div class="row">
                            @forelse($columns as $key=>$col)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">{{$col->name}}</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="{{$col->name}}" value="<?php echo '{{$entity->'.$col->name.'}}'  ; ?>">
                                    </div>
                                </div>
                            </div>
                                @if(($key+1)%2==0)
                                    </div>
                                    <div class="row">
                                @endif
                            @empty
                            @endforelse
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


<?php echo "@endsection"  ; ?>

<?php echo "@section('scripts')"  ; ?>
<script>
    $('.form-submit').on('click', function (e) {
        e.preventDefault();
        App.ajaxForm('#form-id','#alert-id','#blockui-id');
    });
</script>

<?php echo "@endsection"  ; ?>
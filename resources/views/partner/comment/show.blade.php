@extends('partner.layouts.main')
@section('styles')

@endsection

@section('content')
<div class="page-content">
    <div class="page-head">
        <div class="page-title">
            <h1>top module
                <small>comment详情</small>
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-equalizer font-green-haze"></i>
                        <span class="caption-subject font-green-haze bold uppercase">comment详情</span>
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
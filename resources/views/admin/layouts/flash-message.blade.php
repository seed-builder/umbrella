<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        @if (Session::has('message'))
            <div class="alert fade in alert-info"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> {{ Session::get('message') }}</div>
        @endif
        @if (Session::has('success'))
            <div class="alert fade in  alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> {{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert fade in  alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button> {{ Session::get('error') }}</div>
        @endif

        @if (!empty($errors->all()))
            <div class="alert fade in  alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
				<?php $error_arr =  $errors->all();?>
                @foreach ($error_arr as $k=>$item)
                    @if ($k >0)
                        |
                    @endif
                    {{$item}}
                @endforeach
            </div>
        @endif
    </div>
</div>

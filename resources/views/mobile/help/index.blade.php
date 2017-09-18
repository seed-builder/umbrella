@extends('mobile.layouts.app')
@section('css')
    <style>
        .help-item-content{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="page page-current" id="help">
        <header class="bar bar-nav " >
            <a class="icon icon-left pull-left link" data-url="/mobile/home/map" ></a>
            <h1 class='title'>帮助中心</h1>
        </header>
        <div class="content">
            <div class="list-block cards-list">
                <ul>
                    @foreach($entities as $entity)
                    <div class="open-popup card help-item" data-popup="#content-popup" data-name="{{$entity->name}}">
                        <div class="card-content">
                            <div class="card-content-inner">
                                {{$entity->name}}
                                <span class="icon icon-right" style="float: right"></span>
                            </div>
                            <div class="help-item-content">
                                {!! $entity->content !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    <div id="content-popup" class="popup popup-about">
        <header class="bar bar-nav " >
            <a class="icon icon-left pull-left close-popup" ></a>
            <h1 class='title' id="content-title">帮助中心</h1>
        </header>
        <div class="content-block" id="content" style="padding-top: .7rem">

        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $(".help-item").on('click',function(){
            var content = $(this).find(".help-item-content").html();
            $("#content-title").html($(this).data('name'))
            $("#content").html(content)
        })
    </script>
@endsection
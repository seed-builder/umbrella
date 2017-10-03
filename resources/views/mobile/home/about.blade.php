@extends('mobile.layouts.app')
@section('css')
    <style>
        .content img{
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('content')

    <div class="page page-current" id="about">
        <header class="bar bar-nav " >
            <h1 class='title'>关于伞客</h1>
        </header>
        <div class="content" >
            <img src="/images/about-bg.png">
        </div>
    </div>
@endsection

@section('javascript')

@endsection
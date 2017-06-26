@extends('mobile.layouts.app')
@section('css')

@endsection
@section('content')
    <div class="page page-current" id="customer-hire-index">
        <header class="bar bar-nav">
            <a class="icon icon-left pull-left link" data-url="{{url('mobile/home/map')}}"></a>
            <h1 class='title'>用伞纪录</h1>
        </header>
        <div class="bar bar-header-secondary">
            <div class="searchbar">
                <div class="search-input open-popup open-about" data-popup=".popup-about">
                    <label class="icon icon-search" for="search"></label>
                    <input type="search" id='search' placeholder='搜索' readonly/>
                </div>
            </div>
        </div>

        <card-list :options="listOptions"></card-list>

    </div>

    <div class="popup popup-about">
        <div class="content-block">
            <form id="search-form" class="search-form">
                {{ csrf_field() }}
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="iconfont icon-kaishi"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">借伞网点</div>
                                    <div class="item-input">
                                        <input type="text" name="filter[][hire_site]" value="">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="iconfont icon-jieshu"></i></div>
                                <div class="item-inner">
                                    <div class="item-title label">还伞网点</div>
                                    <div class="item-input">
                                        <input type="text" name="filter[][return_site]" value="">
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
                <div class="content-block">
                    <div class="row">
                        <div class="col-50"><a id="form-reset"
                                               class="button button-big button-fill button-danger close-popup" >重置</a>
                        </div>
                        <div class="col-50"><a id="form-search"
                                    class="button button-big button-fill button-success close-popup" >搜索</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {
            seajs.use('mobile/customer_hire.js', function (app) {
                app.index($);
            });
        });
    </script>
@endsection
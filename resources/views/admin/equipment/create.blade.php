@extends('admin.layouts.main')
@section('styles')

@endsection

@section('content')
    <div class="page-content" id="app">
        <div class="page-head">
            <div class="page-title">
                <h1>设备管理
                    <small>设备新增</small>
                </h1>
            </div>
        </div>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">首页</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb" class="active">设备新增</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered" id="blockui-id">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">设备新增</span>
                        </div>

                    </div>
                    {{--action="/admin/equipment/store"--}}
                    <div class="portlet-body form" v-for="(item,index) in entities">
                        <div id="alert-id"></div>
                        <form class="form-horizontal" id="form-id" >
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">设备号</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="item.sn">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">伞容量</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="item.capacity">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">ip</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" v-model="item.ip">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">网点</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="item.site_id">
                                                @foreach($sites as $site)
                                                    <option value="{{$site->id}}">{{$site->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">状态</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="item.status">
                                                <option value="1">未启用</option>
                                                <option value="2">启用</option>
                                                <option value="3">系统故障</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">设备类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="item.type">
                                                <option value="1">伞机设备</option>
                                                <option value="2">手持设备</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row"></div>
                            <hr>

                            <div class="form-actions right" v-if="(index+1)==entities.length">
                                <button type="button" class="btn default back-link">返回</button>
                                <button type="button" class="btn blue" @click="entities.push({})">增加一个</button>
                                <button type="button" class="btn green " @click="submit">提交</button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="/assets/global/scripts/vue.js"></script>
    <script>
        new Vue({
            el : '#app',
            data : {
                entities : [
                    {
                        sn : '',
                        capacity : '',
                        ip : '',
                        site_id : '',
                        status : 1,
                        type : 1,
                    }
                ]
            },
            methods : {
                submit:function(){
                    var self = this;
                    this.entities.forEach(function(item,index){

                        App.ajaxPost(item,'/admin/equipment/store','#alert-id', '#blockui-id',function(){
                            self.entities.splice(index,1)
                        });
                    })
                }
            }
        })
        $('.form-submit').on('click', function (e) {
            e.preventDefault();
            App.ajaxForm('#form-id', '#alert-id', '#blockui-id');
        });
    </script>

@endsection
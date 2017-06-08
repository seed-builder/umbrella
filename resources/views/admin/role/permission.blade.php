@extends('admin.layouts.main')
@section('styles')
    <link type="text/css" href="/assets/global/plugins/bootstrap-treeview/bootstrap-treeview.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEAD-->
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>用户权限管理
                    <small>设置权限</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            @include('admin.layouts.page-toolbar')
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="/admin/">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span id="breadcrumb"  class="active">设置权限</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-xs-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-docs font-dark"></i>
                            <span class="caption-subject bold uppercase font-dark">角色【{{$role->display_name}}】权限设置</span>
                            {{--<span class="caption-helper">distance stats...</span>--}}
                        </div>
                        <div class="tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-wrench"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" id="btnOpen"><i class="fa fa-folder-open"></i>展开</a></li>
                                    <li><a href="#" id="btnCollapse"><i class="fa fa-folder"></i>折叠</a></li>
                                </ul>
                            </div>
                            <a href="" class="collapse"> </a>
                            {{--<a href="#portlet-config" data-toggle="modal" class="config"> </a>--}}
                            {{--<a href="" class="reload"> </a>--}}
                            {{--<a href="" class="remove"> </a>--}}
                        </div>

                    </div>
                    <div class="portlet-body">
                        <div id="tree" ></div>
                        <form id="saveForm" method="post" action="#" >
                            {!! csrf_field() !!}
                            <input name="perms" id="perms" type="hidden">
                        </form>
                        <input class="btn btn-primary" type="button" value="保存" onclick="saveRolePerm()">
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('scripts')
    <script src="/assets/global/plugins/bootstrap-treeview/bootstrap-treeview.min.js"></script>
    <script type="text/javascript">
        function cball(cb) {
            //alert(cb.checked);
            if(cb.checked){
                $('.cb').each(function(i, el){
                    //alert(el);
                    el.checked = true;
                });
            }else{
                $('.cb').each(function(i, el){
                    //alert(el);
                    el.checked = false;
                });
            }
        }

        function cbsingle(tr) {
            $('input[type=checkbox]', $(tr)).click();
        }
        var treeData = {!! json_encode($perms) !!} ;
        $(function () {
            $("#tree").treeview({
                color: "#428bca",
                levels: 99,
                data: treeData,
                showIcon: false,
                showCheckbox:true,
                onNodeChecked:nodeChecked ,
                onNodeUnchecked:nodeUnchecked
            });
        });

        function saveRolePerm() {
            var nodes = $("#tree").treeview('getChecked');
            var ids = [];
            for(var i = 0; i < nodes.length; i++){
                ids[ids.length] = nodes[i].dataid;
            }
            //alert(ids.join(','));
            $('#perms').val(ids.join(','));
            $('#saveForm').submit();
        }
    </script>
    <script>
        var nodeCheckedSilent = false;
        function nodeChecked (event, node){
            if(nodeCheckedSilent){
                return;
            }
            nodeCheckedSilent = true;
            checkAllParent(node);
            checkAllSon(node);
            nodeCheckedSilent = false;
        }

        var nodeUncheckedSilent = false;
        function nodeUnchecked  (event, node){
            if(nodeUncheckedSilent)
                return;
            nodeUncheckedSilent = true;
            uncheckAllParent(node);
            uncheckAllSon(node);
            nodeUncheckedSilent = false;
        }

        //选中全部父节点
        function checkAllParent(node){
            $('#tree').treeview('checkNode',node.nodeId,{silent:true});
            var parentNode = $('#tree').treeview('getParent',node.nodeId);
            if(!("id" in parentNode)){
                return;
            }else{
                checkAllParent(parentNode);
            }
        }
        //取消全部父节点
        function uncheckAllParent(node){
            $('#tree').treeview('uncheckNode',node.nodeId,{silent:true});
            var siblings = $('#tree').treeview('getSiblings', node.nodeId);
            var parentNode = $('#tree').treeview('getParent',node.nodeId);
            if(!("id" in parentNode)) {
                return;
            }
            var isAllUnchecked = true;  //是否全部没选中
            for(var i in siblings){
                if(siblings[i].state.checked){
                    isAllUnchecked=false;
                    break;
                }
            }
            if(isAllUnchecked){
                uncheckAllParent(parentNode);
            }

        }

        //级联选中所有子节点
        function checkAllSon(node){
            $('#tree').treeview('checkNode',node.nodeId,{silent:true});
            if(node.nodes!=null&&node.nodes.length>0){
                for(var i in node.nodes){
                    checkAllSon(node.nodes[i]);
                }
            }
        }
        //级联取消所有子节点
        function uncheckAllSon(node){
            $('#tree').treeview('uncheckNode',node.nodeId,{silent:true});
            if(node.nodes!=null&&node.nodes.length>0){
                for(var i in node.nodes){
                    uncheckAllSon(node.nodes[i]);
                }
            }
        }
    </script>

@endsection
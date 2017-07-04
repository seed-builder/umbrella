/**
*
*/
define(function(require, exports, module) {

    var zhCN = require('datatableZh');
    var editorCN = require('i18n');
    exports.index = function ($, tableId, treeId) {
        var curNodeData;

        var icon_picker = $('#icon_picker').fontIconPicker({});
        var getTreeData = function () {
            $.ajax({
                url: "/admin/permission/tree",
                type: "GET",
                //data: {'_token':$('meta[name="_token"]').attr('content')},
                dataType:'json',
                success:function(data){
                    $("#" + treeId).treeview({
                        color: "#428bca",
                        enableLinks: true,
                        levels: 99,
                        data: data,
                        onNodeSelected: function(event, data) {
                            curNodeData = data;

                            for(var p in data.item){
                                $('#'+p, '#permissionForm').val(data.item[p]);
                            }
                            $('#icon').selectpicker('val', data.item['icon']);
                            $('#pid').selectpicker('val', data.item['pid']);
                            $('#type').selectpicker('val', data.item['type']);
                            icon_picker.selectedIcon(data.item['icon'])

                        },
                        onNodeUnselected: function(event, data) {
                            curNodeData=null;
                        },
                    });
                },
            });
        }




        getTreeData();

        //tree btn
        $('#btnAddChild').click(function () {
            if (!curNodeData) {
                layer.alert('请先选择职位!');
                return;
            }
            $('#permissionForm')[0].reset();
            $('#id').val(0);
            // $('#pid').val(curNodeData['dataid']);
            $('#pid').selectpicker('val', curNodeData['dataid']);

        });

        $('#btnAddSame').click(function () {
            if (!curNodeData) {
                layer.alert('请先选择职位!');
                return;
            }
            $('#permissionForm')[0].reset();
            $('#id').val(0);
            // $('#pid').val(curNodeData['item']['pid']);
            $('#pid').selectpicker('val', curNodeData['item']['pid']);
        });



        $('#btnRemove').click(function () {
            if (!curNodeData) {
                layer.alert('请先选择职位!');
                return;
            }
            var title = '确定删除 ' + curNodeData.item['display_name']+ ' 及下属所有职位 ?';
            layer.confirm(title, {
                title: '提示',
                buttons: ['确定', '取消'],
            }, function () {
                $.post('/admin/permission/' + curNodeData['dataid'], {
                    _method: 'delete',
                    _token: $('meta[name="_token"]').attr('content')
                }, function (res) {
                    layer.msg('成功!');
                    window.location.reload(true);
                })
            }, function () {
                layer.close();
            });
        });

        $('#permissionForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    validators: {
                        notEmpty: {},
                    }
                },
                display_name: {
                    validators: {
                        notEmpty: {},
                    }
                },
                pid: {
                    validators: {
                        notEmpty: {},
                    }
                },

            }
        }).on('success.form.bv', function (e) {
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function (result) {
                if(result)
                {
                    layer.msg('保存成功!');
                    window.location.reload(true);
                }
            }, 'json');
        });

    }

});
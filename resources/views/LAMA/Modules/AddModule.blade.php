
<!-- begin col-12 -->
<div class="col-lg-12" id="section_addModule">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">اضافه کردن ماژول جدید</h4>
        </div>
        <div class="panel-body">
            <form class="form-hoizontal" id="form-addModule" data-parsley-validate="true">
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">title * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="title" data-parsley-minlength="3" data-parsley-required="true" type="text" placeholder="title"/>

                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">sys title * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="sys_title" data-parsley-minlength="3" data-parsley-required="true" type="text" placeholder="sys title"/>

                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">file name * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="file_name" data-parsley-minlength="3" data-parsley-required="true" type="text" placeholder="file name"/>

                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">select parent module :<br><small>(if this is main module, dont select any module)</small></label>
                    <div class="col-md-8">
                        <select class="form-control" name="parent_id" id="select_module">
                        </select>

                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">is this module enable? :</label>
                    <div class="col-md-8">
                        <input type="checkbox" name="status" value="1" checked>

                    </div>
                </div>

                <hr>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">methods :</label>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-default m-r-5 m-b-5" onclick="CreatAddMethodInput()">add new method</button>
                    </div>
                </div>
                <div class="form-group row m-b-15 add-method-field">

                </div>

                <hr>

                <div class="form-group row m-b-0">
                    <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                    <div class="col-md-8 col-sm-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>

    </div>
    <!-- end panel -->
</div>
<!-- end col-12 -->

<script>

    var methodCount = 0;
    function CreatAddMethodInput() {
        var x = '<div class="row" id="addMethod_' + methodCount + '">' +
            '<div class="col-md-3">\n' +
            '                            <label class="col-md-12 col-sm-12 col-form-label">method public name :</label>\n' +
            '                            <div class="col-md-12 col-sm-12">\n' +
            '                                <input class="form-control" name="method-public_name' + methodCount + '" data-parsley-required="true" type="text" placeholder="method name"/>\n' +
            '\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '         <div class="col-md-3">\n' +
        '                            <label class="col-md-12 col-sm-12 col-form-label">method sys name :</label>\n' +
        '                            <div class="col-md-12 col-sm-12">\n' +
        '                                <input class="form-control" name="method-sys_name' + methodCount + '" data-parsley-required="true" type="text" placeholder="method name"/>\n' +
        '                            </div>\n' +
        '                        </div>\n' +
            '                    <div class="col-md-2">\n' +
            '                            <label class="col-md-12 col-sm-12 col-form-label">method type :</label>\n' +
            '                            <div class="col-md-12 col-sm-12">\n' +
            '                                <select class="form-control" name="method-type' + methodCount + '" data-parsley-required="true" type="text" placeholder="sys title">\n' +
            '                                    <option value="read">read</option>\n' +
            '                                    <option value="save">save</option>\n' +
            '                                    <option value="edit">edit</option>\n' +
            '                                    <option value="remove">remove</option>\n' +
            '                                </select>\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '<div class="col-md-2">\n' +
            '<label class="col-md-12 col-form-label">status :</label>\n' +
            '                    <div class="col-md-12">\n' +
            '                        <input type="checkbox" name="method-status' + methodCount + '" value="1" checked>\n' +
            '\n' +
            '                    </div>' +
            '                    </div>' +
            '<div class="col-md-2">\n' +
            '                    <div class="col-md-12">\n' +
            '<a href="javascript:;" onclick="removeMethodRow(' + methodCount + ')" class="btn btn-danger btn-icon btn-circle btn-lg remove-method-row"><i class="fa fa-times"></i></a>' +
            '\n' +
            '                    </div>' +
            '                    </div></div>'
        ;
        $('.add-method-field').append(x);
        methodCount++;
    }


    function removeMethodRow(methodN) {
        $('#addMethod_' + methodN).remove();
    }

    var F_addModule = $('#form-addModule').parsley();
    $(function(){

        $('#form-addModule').submit(function (e) {
            e.preventDefault();
            if (F_addModule.isValid()) {
                var methods = [];
                for (var j = 0; j < methodCount; j++) {
                    if ($('input[name=method-public_name' + j + ']').val() != undefined) {
                        console.log($('input[name=method-public_name' + j + ']').val());
                        methods[j] = {
                            'public_name': $('input[name=method-public_name' + j + ']').val(),
                            'sys_name': $('input[name=method-sys_name' + j + ']').val(),
                            'type': $('select[name=method-type' + j + ']').val(),
                            'status': 1,//TODO
                        };
                    }
                }
                var formData = {
                    'title': $('#form-addModule input[name=title]').val(),
                    'sys_title': $('#form-addModule input[name=sys_title]').val(),
                    'file_name': $('#form-addModule input[name=file_name]').val(),
                    'status': $('#form-addModule input[name=status]').val(),
                    'parent_id': $('#form-addModule select[name=parent_id]').val(),
                    'methods': methods,
                    'icon': ''
                };
                var res = AJAXRequest('/admin/sys/module/add_module/addModule', 'post', {
                    'data': formData,
                    '_SC': SC
                }, 1);


                if (res['status'] == true) {
                    section_addModule();
                    //TODO reset form and parsley classes
                }
            }
        });

    });
</script>

<script>

    async function section_addModule() {
        var modulesRequest = AJAXRequest('/admin/sys/module/add_module/getModulesList', 'get', {'_SC': SC}, 6);
        var modules = modulesRequest['data']['modules'];
        $('#select_module').html('');
        $('#select_module').append('<option style="color: black;" value="">select module</option>');
        for (var i = 0; i < modules.length; i++) {
            $('#select_module').append('<option style="color: black;" value="' + modules[i]['id'] + '">' + modules[i]['title'] + '</option>');
        }
    }


</script>
<script>
    $(document).ready(function () {
        section_addModule();
    });

</script>

<link href="{{ asset('/LAMA/templates/_1/assets/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" />




<div class="col-md-12 m-b-15">
    <button type="button" class="btn btn-lime" onclick="$('#section_addRole').show()">اضافه کردن نقش</button>
</div>

<div class="col-md-12" style="display: block" id="section_addRole">
    <div class="panel panel-inverse" data-sortable-id="ui-buttons-1" style="">
        <!-- begin panel-heading -->
        <div class="panel-heading ui-sortable-handle">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">اضافه کردن نقش</h4>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">



            <form class="form-horizontal" id="form-addRole" dir="rtl" data-parsley-validate="true" name="demo-form" novalidate="">
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label rtl">عنوان فارسی نقش * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" type="text" name="fa_title" placeholder="عنوان" data-parsley-required="true">
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label rtl">عنوان انگلیسی نقش * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" type="text" name="en_title" placeholder="عنوان" data-parsley-required="true">
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label rtl">توضیحات نقش * :</label>
                    <div class="col-md-8 col-sm-8">
                        <textarea class="form-control" type="text" name="description" placeholder="توضیحات" data-parsley-required="true"></textarea>
                    </div>
                </div>

                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label rtl">تخصیص ماژول * :</label>
                    <div class="col-md-8 col-sm-8" id="modules_selection">

                    </div>

                </div>


                <div class="form-group row m-b-0">
                    <label class="col-md-4 col-sm-4 col-form-label">&nbsp;</label>
                    <div class="col-md-8 col-sm-8">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-primary" onclick="$('#section_addRole').hide()">انصراف</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end panel-body -->
    </div>

</div>



<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/js/demo/table-manage-keytable.demo.min.js') }}"></script>

<script src="{{ asset('/LAMA/templates/_1/assets/plugins/jstree/dist/jstree.min.js') }}"></script>

<!-- ================== END PAGE LEVEL JS ================== -->

<script>

</script>






<script>
    /**
     * SECTIONS
     */
    function section_rolesList() {
        var rolesRequest = AJAXRequest('/admin/sys/module/role_management/getRolesList', 'get', {'_SC': SC}, 6);
        //console.log(rolesRequest);
        if (rolesRequest['status'] == 1) {
            var x = '<table id="data-table_rolesList" class="table table-striped table-bordered">\n' +
                '                    <thead>\n' +
                '                    <tr>\n' +
                '                        <th width="1%"></th>\n' +
                '                        <th class="text-nowrap">عنوان</th>\n' +
                '                        <th class="text-nowrap">actions</th>\n' +
                '                    </tr>\n' +
                '                    </thead>\n' +
                '                    <tbody>\n' +
                '                    </tbody>\n' +
                '                </table>';
            $('#section-body_rolesList').html(x);
            var t = $('#data-table_rolesList').DataTable();
            t.clear()
            var roles = rolesRequest['data']['roles'];
            for (var i = 0; i < roles.length; i++) {
                t.row.add(
                    [
                        i + 1,
                        roles[i]['title'],
                        '<a href="javascript:;" style="margin-right: 15px" onclick="editRole(' + roles[i]['id'] + ')"><i class="fa fa-edit"></i>تغییر</a>' +
                        '<a href="javascript:;" style="margin-right: 15px" onclick="removeRole(' + roles[i]['id'] + ')"><i class="fa fa-trash"></i>حذف</a>'
                    ]
                ).draw(true);
            }
        }
    }

    function section_addRole() {
        var modules = AJAXRequest('/admin/sys/getMyModules', globalSysRequestMethod, '', 6);
        function creatModulesTree(modules, isOpen) {
            var out = [];
            for (var key in modules) {
                var children = [];
                if (modules[key]['has_child'] != 0) {
                    children = creatModulesTree(modules[key]['sub_module'], 1);
                } else {
                    children = [
                        {text: 'دیدن', icon: 'fa fa-file', id: modules[key]['id'] + '_read',},
                        {text: 'ثبت', icon: 'fa fa-file', id: modules[key]['id'] + '_save',},
                        {text: 'خذف', icon: 'fa fa-file', id: modules[key]['id'] + '_remove',},
                        {text: 'تغییر', icon: 'fa fa-file', id: modules[key]['id'] + '_edit',},
                    ]
                }
                out.push({
                    id: modules[key]['id'],
                    text: modules[key]['title'],
                    state: {
                        opened: (modules[key]['has_child'] != 0) ? true: false,
                    },
                    children: children
                });
            }
            return out;
        }

        $("#modules_selection").jstree({
            plugins: ["wholerow", "checkbox", "types"],
            core: {
                themes: {responsive: 1},
                data: creatModulesTree(modules['data'])
            },
            types: {"default": {icon: "f"}, file: {icon: ""}}
        });
    }


    /**
     * BUTTONS
     */
    function removeRole(id) {
        Swal.fire({
            title: 'ایا اطمینان دارید؟',
            text: "می خواهید این نقش را حذف نمایید",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'بازگشت',
            confirmButtonColor: '#d92800',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'تایید'
        }).then((result) => {
            if (result.value) {
                AJAXRequest(
                    '/admin/sys/module/role_management/removeRole',
                    'post',
                    {'data': {'id': id}, '_SC': SC},
                    1
                );
                section_rolesList();
            }
        })
    }


    /**
     * FORMS
     */
    var F_addRole = $('#form-addRole').parsley();
    $(function(){

        $('#form-addRole').submit(function (e) {
            e.preventDefault();
            var modules = ($("#modules_selection").jstree("get_selected",true));

            if (F_addRole.isValid()) {

                var formData = {
                    'fa_title': $('#form-addRole input[name=en_title]').val(),
                    'en_title': $('#form-addRole input[name=fa_title]').val(),
                    'description': $('#form-addRole textarea[name=description]').html(),
                    'modules': modules,
                };

                console.log(formData);



                var res = AJAXRequest('/admin/sys/module/role_management/addRole', 'post', {
                    'data': formData,
                    '_SC': SC
                }, 1);

                console.log(res);
                /*
                if (res['status'] == true) {
                    section_addRole();
                    section_rolesList();
                    $('#section_addRole').hide();
                    //TODO reset form and parsley classes
                }

                 */
            }
        });

    });







</script>
<script>
    $(document).ready(function () {
        createSections([
            {'type': 1, 'title': 'لیست نقش ها', 'id': 'rolesList'},
        ]);


        section_rolesList();
        section_addRole();



    });

</script>

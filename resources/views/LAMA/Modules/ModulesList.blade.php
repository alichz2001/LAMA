<!-- begin col-12 -->
<div class="col-lg-12" id="section_editModule">
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
            <form class="form-hoizontal" id="form-editModule" data-parsley-validate="true">
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
                    <div class="col-md-4">
                        <p id="last_parent"></p>
                    </div>
                    <div class="col-md-4">
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




<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/js/demo/table-manage-keytable.demo.min.js') }}"></script>


<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    async function section_modulesList() {
        var modulesRequest = AJAXRequest('/admin/sys/module/modules_list/getModulesList', 'get', {'_SC': SC}, 6);
        if (modulesRequest['status'] == 1) {
            var x = '<table id="data-table_modulesList" class="table table-striped table-bordered">\n' +
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
            $('#section-body_modulesList').html(x);
            var t = $('#data-table_modulesList').DataTable();
            t.clear()
            var modules = modulesRequest['data']['modules'];
            for (var i = 0; i < modules.length; i++) {
                t.row.add(
                    [
                        i + 1,
                        modules[i]['title'],
                        '<a style="margin-left: 30px;" href="javascript:;" data-button-type="module-edit" data-module-id="' + modules[i]['id'] + '"><i class="fa fa-edit"></i>EDIT</a>' +
                        '<a style="margin-left: 30px;" href="javascript:;"><i class="fa fa-trash"></i>REMOVE</a>'
                    ]
                ).draw(true);
            }
        }
    }







    async function editModule(id) {
        console.log(moduleDetails);
    }


</script>
<script>
    $(document).ready(function () {
        createSections([
            {'title': 'لیست ماژول ها', 'id': 'modulesList', 'type': 1},
        ]);
        section_modulesList();

        $('#section_editModule').hide();
        $('a[data-button-type=module-edit]').on('click', function () {
            var moduleDetails = AJAXRequest('/admin/sys/module/modules_list/getModuleDetails', 'post', {'data': {'id': this.getAttribute('data-module-id')}, '_SC': SC}, 6);
            $('#form-editModule input[name=title]').val(moduleDetails['data']['module_details']['title']);
            $('#form-editModule input[name=sys_title]').val(moduleDetails['data']['module_details']['sys_title']);
            $('#form-editModule input[name=file_name]').val(moduleDetails['data']['module_details']['file_name']);
            var modulesList = AJAXRequest('/admin/sys/module/modules_list/getModulesList', 'get', {'_SC': SC}, 6);
            var modules = modulesList['data']['modules'];
            $('#select_module').append('<option style="color: black;" value="">select module</option>');
            for (var i = 0; i < modules.length; i++) {
                $('#select_module').append('<option style="color: black;" value="' + modules[i]['id'] + '">' + modules[i]['title'] + '</option>');
            }
            $('#form-editModule p[id=last_parent]').html('uywdfg');
            $('#section_editModule').show();

            console.log(moduleDetails['data']['module_details']);
        })
    });


</script>

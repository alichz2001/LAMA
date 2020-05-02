<link href="{{ asset('LAMA/templates/_1/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />

<link href="{{ asset('LAMA/templates/_1/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />


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
            <form class="form-hoizontal" id="form-addModule">
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">title * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="title" type="text" placeholder="title"/>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">sys title * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="sys_title" type="text" placeholder="sys title"/>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">file name * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="file_name" type="text" placeholder="file name"/>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">select parent module :<br><small>(if this is main module, dont select any module)</small></label>
                    <div class="col-md-8">
                        <select class="form-control" name="parent_id" id="select_module">
                        </select>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">is this module enable? :</label>
                    <div class="col-md-8">
                        <input type="checkbox" name="status" value="1" checked>
                        <p class="error-field"></p>
                    </div>
                </div>
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
    $(function(){
        $('#form-addModule').submit(function(e){
            e.preventDefault();
            var formData = {
                'title': $('#form-addModule input[name=title]').val(),
                'sys_title': $('#form-addModule input[name=sys_title]').val(),
                'file_name': $('#form-addModule input[name=file_name]').val(),
                'status': $('#form-addModule input[name=status]').val(),
                'parent_id': $('#form-addModule select[name=parent_id]').val(),
                'icon': ''
            };
            var res = AJAXRequest('/admin/sys/module/module_management/addModule', 'post', {'data': formData, '_SC': SC});
            setFormErrors('form-addModule', res['data']['formErrors']);
        });
    });
</script>

<script>
    async function section_modulesList() {
        var modulesRequest = AJAXRequest('/admin/sys/module/Module_management/getModulesList', 'get', {'_SC': SC}, 6);
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
                        '<a href="javascript:;" onclick=""><i class="fa fa-edit"></i></a>'
                    ]
                ).draw(true);
            }
        }
    }

    async function section_addModule() {
        var modulesRequest = AJAXRequest('/admin/sys/module/Module_management/getModulesList', 'get', {'_SC': SC}, 6);
        var modules = modulesRequest['data']['modules'];
        $('#select_module').append('<option style="color: black;" value="">select module</option>');
        for (var i = 0; i < modules.length; i++) {
            $('#select_module').append('<option style="color: black;" value="' + modules[i]['id'] + '">' + modules[i]['title'] + '</option>');
        }
    }


</script>
<script>
    $(document).ready(function () {
        createSections([
            {'title': 'modules list', 'id': 'modulesList', 'type': 1}
        ]);
        section_modulesList();
        section_addModule();

    });

</script>

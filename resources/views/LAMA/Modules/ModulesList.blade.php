


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
                        '<a href="javascript:;" onclick=""><i class="fa fa-edit"></i></a>'
                    ]
                ).draw(true);
            }
        }
    }




</script>
<script>
    $(document).ready(function () {
        createSections([
            {'title': 'لیست ماژول ها', 'id': 'modulesList', 'type': 1}
        ]);
        section_modulesList();
        app.init();
    });

</script>

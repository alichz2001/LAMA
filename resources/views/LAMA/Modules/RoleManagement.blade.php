<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/js/demo/table-manage-keytable.demo.min.js') }}"></script>


<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    async function section_rolesList() {
        var rolesRequest = AJAXRequest('/admin/sys/module/role_management/getRolesList', 'get', {'_SC': SC}, 6);
        console.log(rolesRequest);
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
            {'type': 1, 'title': 'لیست نقش ها', 'id': 'rolesList'},
        ]);
        section_rolesList();


    });

</script>





<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/Admin/templates/_1/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/js/demo/table-manage-keytable.demo.min.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->


<script>

    function addError() {
        var form = $('#add-error')[0];
        var formData = new FormData(form);
        //var x = AJAXRequest('/admin/sys/module/6/addError', 'get', formData);
        $.ajax({
            url: '/admin/sys/module/errors_management/addError',
            method: 'post',
            data: formData,
            async: false,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function (data) {
                //TODO

                console.log(data);
            },
            error: function () {
                //TODO
            }

        });
    }

</script>



<script>


    async function section_errorsList() {
        $('#section-body_errorsList').html(x);
        var x = '<table id="data-table-errorsList" class="table table-striped table-bordered">\n' +
            '                    <thead>\n' +
            '                    <tr>\n' +
            '                        <th width="1%"></th>\n' +
            '                        <th class="text-nowrap">code</th>\n' +
            '                        <th class="text-nowrap">description</th>\n' +
            '                        <th class="text-nowrap">type</th>\n' +
            '                        <th class="text-nowrap">cause</th>\n' +
            '                        <th class="text-nowrap">file</th>\n' +
            '                        <th class="text-nowrap">method</th>\n' +
            '                        <th class="text-nowrap">actions</th>\n' +
            '                    </tr>\n' +
            '                    </thead>\n' +
            '                    <tbody>\n' +
            '                    </tbody>\n' +
            '                </table>';
        $('#section-body_errorsList').html(x);

        var x = AJAXRequest('/admin/sys/module/errors_management/getErrorsList', 'get', '');
        var t = $('#data-table-errorsList').DataTable();
        t.clear();
        for (var i = 0; i < x['data'].length; i++) {
            t.row.add(
                [
                    i+1,
                    x['data'][i]['code'],
                    x['data'][i]['description'],
                    x['data'][i]['type'],
                    x['data'][i]['cause'],
                    x['data'][i]['file'],
                    x['data'][i]['method'],
                    '<a href="javascript:;" onclick=""><i class="fa fa-edit"></i></a>'
                ]
            ).draw( false );
        }
    }
    async function section_addError() {
        var x = '<form id="add-error" method="post">\n' +
            '                    <div class="form-group row m-b-15">\n' +
            '                        <label class="col-sm-3 col-form-label">description</label>\n' +
            '                        <div class="col-sm-9">\n' +
            '                            <textarea name="description" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 92px;"></textarea>                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="form-group row m-b-15">\n' +
            '                        <label class="col-sm-3 col-form-label">error code</label>\n' +
            '                        <div class="col-sm-9">\n' +
            '                            <input type="text" name="code" class="form-control">\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="form-group row m-b-15">\n' +
            '                        <label class="col-sm-3 col-form-label">error type</label>\n' +
            '                        <div class="col-sm-9">\n' +
            '                            <select name="type" class="form-control">\n' +
            '                                <option value="2">error</option>\n' +
            '                                <option value="3">warning</option>\n' +
            '                            </select>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="form-group row m-b-15">\n' +
            '                        <label class="col-sm-3 col-form-label">file</label>\n' +
            '                        <div class="col-sm-9">\n' +
            '                            <input name="file" type="text" class="form-control">\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="form-group row m-b-15">\n' +
            '                        <label class="col-sm-3 col-form-label">method</label>\n' +
            '                        <div class="col-sm-9">\n' +
            '                            <input name="method" type="text" class="form-control">\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="col-md-7 offset-md-3">\n' +
            '                        <button type="button" onclick="addError()" class="btn btn-sm btn-primary m-r-5">Login</button>\n' +
            '                    </div>\n' +
            '                </form>';
        $('#section-body_addError').html(x);

    }




    createSections([
        {'type': 1, 'title': 'لیست ارور ها', 'id': 'errorsList'},
        {'type': 1, 'title': 'اضافه کردن ارور جدید', 'id': 'addError'}
    ]);

    $(document).ready(function() {
        section_errorsList();
        section_addError();
        TableManageKeyTable.init();
    });
</script>

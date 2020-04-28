<div class="row">

    <!-- begin col-3 -->
    <div class="col-lg-3 col-md-6">
        <div class="widget widget-stats bg-green">
            <div class="stats-icon"><i class="fa fa-link"></i></div>
            <div class="stats-info">
                <h4>اضافه کردن ارور جدید</h4>
                <p></p>
            </div>
            <div class="stats-link">
                <a href="#addError"><i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- end col-3 -->

</div>

<!-- begin row -->
<div class="row">

    <!-- begin col-12 -->
    <div class="col-lg-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" onclick="listErrors()"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">لیست ارور ها</h4>
            </div>
            <!-- end panel-heading -->

            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="data-table-errorsList" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="1%"></th>
                        <th class="text-nowrap">code</th>
                        <th class="text-nowrap">description</th>
                        <th class="text-nowrap">type</th>
                        <th class="text-nowrap">cause</th>
                        <th class="text-nowrap">file</th>
                        <th class="text-nowrap">method</th>
                        <th class="text-nowrap">actions</th>
                    </tr>
                    </thead>
                    <tbody>




                    </tbody>
                </table>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
    <div class="col-lg-12">
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">
                    اضافه کردن ارور
                </h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <form id="add-error" method="post">
                    <div class="form-group row m-b-15">
                        <label class="col-sm-3 col-form-label">description</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 92px;"></textarea>                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-sm-3 col-form-label">error code</label>
                        <div class="col-sm-9">
                            <input type="text" name="code" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-sm-3 col-form-label">error type</label>
                        <div class="col-sm-9">
                            <select name="type" class="form-control">
                                <option value="2">error</option>
                                <option value="3">warning</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-sm-3 col-form-label">file</label>
                        <div class="col-sm-9">
                            <input name="file" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row m-b-15">
                        <label class="col-sm-3 col-form-label">method</label>
                        <div class="col-sm-9">
                            <input name="method" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-7 offset-md-3">
                        <button type="button" onclick="addError()" class="btn btn-sm btn-primary m-r-5">Login</button>
                    </div>
                </form>
            </div>
            <!-- end panel-body -->
        </div>

    </div>
</div>
<!-- end row -->



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
            url: '/admin/sys/module/6/addError',
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
    function listErrors() {
        var x = AJAXRequest('/admin/sys/module/6/getErrorsList', 'get', '');
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

</script>
<script>
    $(document).ready(function() {
        listErrors();
        TableManageKeyTable.init();
    });
</script>

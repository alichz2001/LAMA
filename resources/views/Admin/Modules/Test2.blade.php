<!-- begin row -->
<div class="row">
    <!-- begin col-2 -->
    <div class="col-lg-2">
        <h5>
            Key features include:
        </h5>
        <ul class="p-l-25 m-b-15">
            <li>Easy to use spreadsheet like interaction</li>
            <li>Fully integrated with DataTables</li>
            <li>Wide range of supported events</li>
        </ul>
        <p class="m-b-20">
            <a href="http://www.datatables.net/extensions/keytable/" target="_blank" class="btn btn-inverse btn-sm">View Official Website</a>
        </p>
    </div>
    <!-- end col-2 -->
    <!-- begin col-10 -->
    <div class="col-lg-10">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">DataTable - KeyTable</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin alert -->
            <div class="alert alert-success fade show">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                KeyTable provides enhanced accessibility and navigation options for DataTables enhanced tables, by allowing Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells to allow advanced interaction options.
            </div>
            <!-- end alert -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="data-table-keytable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="1%"></th>
                        <th width="1%" data-orderable="false"></th>
                        <th class="text-nowrap">Rendering engine</th>
                        <th class="text-nowrap">Browser</th>
                        <th class="text-nowrap">Platform(s)</th>
                        <th class="text-nowrap">Engine version</th>
                        <th class="text-nowrap">CSS grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="odd gradeX">
                        <td width="1%" class="f-s-600">1</td>
                        <td width="1%" class="with-img"><img src="{{ asset('/Admin/templates/_1/assets/img/user/user-1.jpg') }}" class="img-rounded height-30" /></td>
                        <td>Trident</td>
                        <td>Internet Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td>4</td>
                        <td>X</td>
                    </tr>
                    <tr class="even gradeC">
                        <td width="1%" class="f-s-600">2</td>
                        <td width="1%" class="with-img"><img src="{{ asset('/Admin/templates/_1/assets/img/user/user-2.jpg') }}" class="img-rounded height-30" /></td>
                        <td>Trident</td>
                        <td>Internet Explorer 5.0</td>
                        <td>Win 95+</td>
                        <td>5</td>
                        <td>C</td>
                    </tr>



                    </tbody>
                </table>
            </div>
            <!-- end panel-body -->
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
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
    $(document).ready(function() {
        TableManageKeyTable.init();
    });
</script>

<link href="{{ asset('LAMA/templates/_1/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />

<link href="{{ asset('LAMA/templates/_1/assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />


<!-- begin col-12 -->
<div class="col-lg-12" id="section_addMethod">
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
            <form class="form-hoizontal" id="form-addMethod" data-parsley-validate="true">
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">title * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="title" data-parsley-minlength="3" data-parsley-required="true" type="text" placeholder="title"/>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">sys title * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="sys_title" data-parsley-minlength="3" data-parsley-required="true" type="text" placeholder="sys title"/>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-sm-4 col-form-label">file name * :</label>
                    <div class="col-md-8 col-sm-8">
                        <input class="form-control" name="file_name" data-parsley-minlength="3" data-parsley-required="true" type="text" placeholder="file name"/>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">select parent Method :<br><small>(if this is main Method, dont select any Method)</small></label>
                    <div class="col-md-8">
                        <select class="form-control" name="parent_id" id="select_Method">
                        </select>
                        <p class="error-field"></p>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-4 col-form-label">is this Method enable? :</label>
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



<script>
    var F_addMethod = $('#form-addMethod').parsley();
    $(function(){

        $('#form-addMethod').submit(function (e) {
            e.preventDefault();
            if (F_addMethod.isValid()) {
                var formData = {
                    'title': $('#form-addMethod input[name=title]').val(),
                    'sys_title': $('#form-addMethod input[name=sys_title]').val(),
                    'file_name': $('#form-addMethod input[name=file_name]').val(),
                    'status': $('#form-addMethod input[name=status]').val(),
                    'parent_id': $('#form-addMethod select[name=parent_id]').val(),
                    'icon': ''
                };
                var res = AJAXRequest('/admin/sys/Method/add_method/addMethod', 'post', {
                    'data': formData,
                    '_SC': SC
                }, 1);
                if (res['status'] == true) {
                    section_addMethod();
                    section_MethodsList();
                    //TODO reset form and parsley classes
                }
            }
        });

    });
</script>

<script>

    async function section_addMethod() {
        var MethodsRequest = AJAXRequest('/admin/sys/Method/add_method/getMethodsList', 'get', {'_SC': SC}, 6);
        var Methods = MethodsRequest['data']['Methods'];
        $('#select_Method').html('');
        $('#select_Method').append('<option style="color: black;" value="">select Method</option>');
        for (var i = 0; i < Methods.length; i++) {
            $('#select_Method').append('<option style="color: black;" value="' + Methods[i]['id'] + '">' + Methods[i]['title'] + '</option>');
        }
    }


</script>
<script>
    $(document).ready(function () {
        section_addMethod();
        app.init();
    });

</script>

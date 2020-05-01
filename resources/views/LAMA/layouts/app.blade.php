<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>LAMA</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/plugins/font-awesome/5.0/css/fontawesome-all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/plugins/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/css/transparent/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/css/transparent/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/LAMA/templates/_1/assets/css/transparent/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->


    <!-- ================== BEGIN MODAL NOTIFICATION STYLE ================== -->
    <link href="{{ asset('/LAMA/templates/_2/css/iziToast.min.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END MODAL NOTIFICATION STYLE ================== -->


    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('/LAMA/templates/_1/assets/plugins/pace/pace.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
<!-- begin page-cover -->
<div class="page-cover"></div>
<!-- end page-cover -->

<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->




@yield('content')



<script>
    const baseURL = '{{ url('/') }}' + '/admin/sys';
    const globalSysRequestMethod = 'get';
    const SC = "{{ $_SC }}";
</script>
<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('/LAMA/templates/_1/assets/crossbrowserjs/html5shiv.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/crossbrowserjs/respond.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/crossbrowserjs/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/js/theme/transparent.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_1/assets/js/apps.min.js') }}"></script>
<!-- ================== END BASE JS ================== -->


<!-- ================== BEGIN MODAL NOTIFICATION JS ================== -->
<script src="{{ asset('/LAMA/templates/_1/assets/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('/LAMA/templates/_2/js/iziToast.min.js') }}"></script>
<!-- ================== END MODAL NOTIFICATION JS ================== -->


<script src="{{ asset('/LAMA/js/LAMA.js') }}"></script>
<script src="{{ asset('/LAMA/js/app.js') }}"></script>
<script src="{{ asset('/LAMA/js/moduleMaker.js') }}"></script>
<script src="{{ asset('/LAMA/js/translateMessage.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        App.init();
        setOrganSelect();
        setRoleSelect();
        setAdminDetails();
        setModulesMenu();

    });
</script>
</body>
</html>

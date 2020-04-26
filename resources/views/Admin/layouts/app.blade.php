<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Color Admin | Page with Right Sidebar</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('/Admin/templates/_1/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/templates/_1/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/templates/_1/assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/templates/_1/assets/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/templates/_1/assets/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/templates/_1/assets/css/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/Admin/templates/_1/assets/css/theme/default.css') }}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('/Admin/templates/_1/assets/plugins/pace/pace.min.js') }}"></script>
    <!-- ================== END BASE JS ================== -->



</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->



@yield('content')


<script>
    const baseURL = '{{ url('/') }}' + '/admin/sys';
    const globalSysRequestMethod = 'get';
</script>
<!-- ================== BEGIN BASE JS ================== -->
<script src="{{ asset('/Admin/templates/_1/assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/jquery/jquery-migrate-1.1.0.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--[if lt IE 9]>
<script src="{{ asset('/Admin/templates/_1/assets/crossbrowserjs/html5shiv.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/crossbrowserjs/respond.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/crossbrowserjs/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('/Admin/templates/_1/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/Admin/templates/_1/assets/plugins/jquery-cookie/jquery.cookie.js') }}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{ asset('/Admin/templates/_1/assets/js/apps.min.js') }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script src="{{ asset('/Admin/js/LAMA.js') }}"></script>
<script src="{{ asset('/Admin/js/app.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        setOrganSelect();
        setRoleSelect();
        setModulesMenu();
        App.init();
    });
</script>
</body>
</html>

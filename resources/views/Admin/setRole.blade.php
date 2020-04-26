<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>






<script src="{{ asset('/Admin/templates/_1/assets/plugins/jquery/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('/Admin/js/LAMA.js') }}"></script>
<script>
    var roles = AJAXRequest('/admin/sys/getMyRoles', 'get', '');
    console.log(roles);
    var x = '';
    for (var i = 0; i < roles['data'].length; i++)
        x += '<a href="javascript:;" onclick="setRole(' + roles['data'][i]['role']['id'] + ',' + roles['data'][i]['organ']['id'] + ')">' + roles['data'][i]['role']['title'] + ' >> ' + roles['data'][i]['organ']['title'] + '</a><br/>';
    $('body').html(x);


    function setRole(roleId, organId) {
        //TODO handle errors
        AJAXRequest('/admin/sys/changeOrgan', 'get', {'id' : organId});
        AJAXRequest('/admin/sys/changeRole', 'get', {'id' : roleId});
        location.reload(true);

    }


</script>
</body>
</html>

function AJAXRequest(url, method, data) {
    //TODO page loader
    var response = {};
    $.ajax({
        url: url,
        method: method,
        data: data,
        async: false,
        //processData: false,
        //contentType: false,
        success: function (data) {
            //TODO

            response = data;
        },
        error: function () {
            //TODO
        }

    });

    //TODO handle errors
    return { data: response['data'], status: response['status']};
}

function setOrganSelect() {
    var organsList = AJAXRequest(baseURL + '/getMyOrgans', globalSysRequestMethod, '');
    var x = '';
    if (organsList['data'].length < 2) {
        //TODO make better UI
        x += '<a href="javascript:;">' + organsList['data'][0]['title'] + '</a>';
    } else {
        x += '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-database fa-fw"></i> organs <b class="caret"></b></a><ul class="dropdown-menu" role="menu" id="ul-organ_list">';
        var currentOrgan = {};
        currentOrgan['id'] = 0;
        currentOrgan = AJAXRequest(baseURL + '/getMyCurrentOrgan', globalSysRequestMethod, '')['data'];
        $('.organ-title').html(currentOrgan['title']);
        for (var i = 0; i < organsList['data'].length; i++)
            x += '<li ' + (organsList['data'][i]['id'] == currentOrgan['id'] ? 'class="active"' : '') + '><a href="javascript:;" ' + (organsList['data'][i]['id'] != currentOrgan['id'] ? 'onclick="changeOrgan(' + organsList['data'][i]['id'] + ')"' : '') + '>' + organsList['data'][i]['title'] + '</a></li>';
        x += '</ul>';
    }
    $('#select-organ-li').html(x);
}

function setRoleSelect() {
    var rolesList = AJAXRequest(baseURL + '/getMyRolesOfCurrentOrgan', globalSysRequestMethod, '')['data'];
    var x = '';
    var currentRole = {};
    currentRole['role'] = '';
    currentRole = AJAXRequest(baseURL + '/getMyCurrentRole', globalSysRequestMethod, '')['data'];
    $('.role-title').html(currentRole['role']);

    if (rolesList.length < 2) {
        //TODO maybe show admin's role
    } else {
        x += '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-user fa-fw"></i> roles <b class="caret"></b></a><ul class="dropdown-menu" role="menu" id="ul-role_list">';
        for (var i = 0; i < rolesList.length; i++)
            x += '<li ' + (currentRole['role'] == rolesList[i]['title'] ? 'class="active"' : '') + '><a href="javascript:;" ' + (currentRole['role'] != rolesList[i]['title'] ? 'onclick="changeRole(' + rolesList[i]['id'] + ')"' : '') + '>' + rolesList[i]['title'] + '</a></li>';
        x += '</ul>';
    }
    $('#select-role-li').html(x);
}

function changeOrgan(id) {
    var res = AJAXRequest(baseURL + '/changeOrgan', globalSysRequestMethod, {'id' : id});
    if (res['status'] == true) {
        setOrganSelect();
        setRoleSelect();
        setModulesMenu();
        $('[module-sys_title=dashboard]').click();

    }
}

function changeRole(id) {
    var res = AJAXRequest(baseURL + '/changeRole', globalSysRequestMethod, {'id' : id});
    if (res['status'] == true) {
        setRoleSelect();
        setModulesMenu();
        $('[module-sys_title=dashboard]').click();

    }
}

function setModulesMenu() {
    $('#menu').html('');
    var modules = AJAXRequest(baseURL + '/getMyModules', globalSysRequestMethod, '')['data'];
    $('#menu').append('<li class="nav-header">Navigation</li>');
    $('#menu').append(createMenu(modules, 1));
    $('[module-sys_title=' + getUrlParameter('module') + ']').click();
    App.initSidebar();
}

function setAdminDetails() {
    var adminDetails = AJAXRequest(baseURL + '/getUserDetails', globalSysRequestMethod, '')['data'];
    $('.username-filed').html(adminDetails['username'])
    $('.name-filed').html(adminDetails['first_name'] + ' ' + adminDetails['last_name'])
}

function createMenu(modules, step) {
    var x = '';
    if (step == 1) {
        var has_child = 0;
        for (var key in modules) {
            has_child = modules[key]['has_child'];

            x += has_child ? '<li class="has-sub">' : '<li>';

            x += has_child ? '<a href="javascript:;">' : '<a href="javascript:;" module-sys_title="' + modules[key]['sys_title'] + '" module-id="' + modules[key]['id'] + '" onclick="setModule(\'' + modules[key]['sys_title'] + '\')">';

            x += has_child ? '<b class="caret"></b>' : '';
            x += '<span>' + modules[key]['title'] + '</span>';
            x += '<i class="fa ' + modules[key]['icon'] + '"></i>';

            x += '</a>';

            x += has_child ? createMenu(modules[key]['sub_module'], 2) : '';
            x += '</li>';
        }
    } else {
        var has_child = 0;
        x += '<ul class="sub-menu">';
        for (var key in modules) {
            has_child = modules[key]['has_child'];
            x += has_child ? '<li class="has-sub">' : '<li>' ;
            x += has_child ? '<a href="javascript:;">' : '<a href="javascript:;" module-sys_title="' + modules[key]['sys_title'] + '" module-id="' + modules[key]['id'] + '" onclick="setModule(\'' + modules[key]['sys_title'] + '\')">';
            x += has_child ? '<b class="caret"></b>' : '';
            x += '<span>' + modules[key]['title'] + '</span>';
            x += '</a>';

            x += has_child ? createMenu(modules[key]['sub_module'], 2) : '';

            x += '</li>';

        }
        x += '</ul>';

    }

    return x;
}

function setModule(sys_title) {
    //TODO make title of page
    window.history.replaceState(null, null, "/admin/?module=" + sys_title);

    $('#module-section').html('');
    var moduleName = $('[module-sys_title=' + sys_title +']').children('span').html();
    $('#module-title').html(moduleName);
    var modulePath = '';
    var x = $('[module-sys_title=' + sys_title +']').parents('li').children('a').children('span').each(function () {
        modulePath += '<li class="breadcrumb-item">' + $(this).html() + '</li>';
    });
    $('#module-path').html(modulePath);
    $('#menu li').removeClass('active');
    $('[module-sys_title=' + sys_title +']').parents('li').addClass('active');


    $.ajax({
        url: baseURL + '/module/' + sys_title + '/view',
        method: globalSysRequestMethod,
        data: {
            '_SC': SC,
        },
        async: false,
        success: function (data) {
            if (data['messageCode'] != undefined) {
                //TODO handle errors
            } else {
                $('#module-section').html(data);
            }
        },
        error: function () {
            //TODO
        }
    });
}


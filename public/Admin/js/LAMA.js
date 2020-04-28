
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
        for (var i = 0; i < organsList['data'].length; i++)
            x += '<li ' + (organsList['data'][i]['id'] == currentOrgan['id'] ? 'class="active"' : '') + '><a href="javascript:;" onclick="changeOrgan(' + organsList['data'][i]['id'] + ')">' + organsList['data'][i]['title'] + '</a></li>';
        x += '</ul>';
    }
    $('#select-organ-li').html(x);
}

function setRoleSelect() {
    var rolesList = AJAXRequest(baseURL + '/getMyRolesOfCurrentOrgan', globalSysRequestMethod, '')['data'];
    var x = '';
    if (rolesList.length < 2) {
        //TODO maybe show admin's role
    } else {
        x += '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-database fa-fw"></i> roles <b class="caret"></b></a><ul class="dropdown-menu" role="menu" id="ul-role_list">';
        var currentRole = {};
        currentRole['role'] = '';
        currentRole = AJAXRequest(baseURL + '/getMyCurrentRole', globalSysRequestMethod, '')['data'];
        for (var i = 0; i < rolesList.length; i++)
            x += '<li ' + (currentRole['role'] == rolesList[i]['title'] ? 'class="active"' : '') + '><a href="javascript:;" onclick="changeRole(' + rolesList[i]['id'] + ')">' + rolesList[i]['title'] + '</a></li>';
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
    }
}

function changeRole(id) {
    var res = AJAXRequest(baseURL + '/changeRole', globalSysRequestMethod, {'id' : id});
    if (res['status'] == true) {
        setRoleSelect();
        setModulesMenu();
    }
}

function setModulesMenu() {
    $('#menu').html('');
    var modules = AJAXRequest(baseURL + '/getMyModules', globalSysRequestMethod, '')['data'];
    $('#menu').append('<li class="nav-header">Navigation</li>');
    $('#menu').append(createMenu(modules, 1));
    $('#menu').append('<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>');

    //TODO make better call for handle menu
    App.initSidebar();
}

function createMenu(modules, step) {
    var x = '';
    if (step == 1) {
        var has_child = 0;
        for (var key in modules) {
            has_child = modules[key]['has_child'];

            x += has_child ? '<li class="has-sub">' : '<li>';

            x += has_child ? '<a href="javascript:;">' : '<a href="javascript:;" module-id="' + modules[key]['id'] + '" onclick="setModule(' + modules[key]['id'] + ')">';

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
            x += has_child ? '<a href="javascript:;">' : '<a href="javascript:;" module-id="' + modules[key]['id'] + '" onclick="setModule(' + modules[key]['id'] + ')">';
            x += has_child ? '<b class="caret"></b>' : '';
            x += modules[key]['title'];
            x += '</a>';

            x += has_child ? createMenu(modules[key]['sub_module'], 2) : '';

            x += '</li>';

        }
        x += '</ul>';

    }

    return x;
}

function setModule(id) {
    //TODO make title of page

    $.ajax({
        url: baseURL + '/module/' + id + '/view',
        method: globalSysRequestMethod,
        data: {},
        async: false,
        success: function (data) {
            //TODO
            $('#module-section').html(data);
        },
        error: function () {
            //TODO
        }
    });
}


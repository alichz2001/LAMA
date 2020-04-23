function AJAXRequest(url, method, data) {
    var response = 0;
    $.ajax({
        url: url,
        method: method,
        data: data,
        async: false,
        success: function (data) {
            //TODO
            response = data;
        },
        error: function (error) {
            //TODO
        }
    });
    //TODO
    return { data: response['data'], status: response['status']};
}

function setCompanySelect() {
    $('#ul-company_list').html('');
    var companiesList = AJAXRequest(baseURL + '/getMyCompanies', globalSysRequestMethod, '')['data'];
    var currentCompany = {};
    currentCompany['id'] = 0;
    currentCompany = AJAXRequest(baseURL + '/getMyCurrentCompany', globalSysRequestMethod, '')['data'];
    for (var i = 0; i < companiesList.length; i++)
        $('#ul-company_list').append('<li ' + (companiesList[i]['id'] == currentCompany['id'] ? 'class="active"' : '') + '><a href="javascript:;" onclick="changeCompany(' + companiesList[i]['id'] + ')">' + companiesList[i]['title'] + '</a></li>');
}

function setRoleSelect() {
    $('#ul-role_list').html('');
    var rolesList = AJAXRequest(baseURL + '/getMyRolesOfCurrentCompany', globalSysRequestMethod, '')['data'];
    var currentRole = {};
    currentRole['role'] = '';
    currentRole = AJAXRequest(baseURL + '/getMyCurrentRole', globalSysRequestMethod, '')['data'];
    for (var i = 0; i < rolesList.length; i++)
        $('#ul-role_list').append('<li ' + (currentRole['role'] == rolesList[i]['title'] ? 'class="active"' : '') + '><a href="javascript:;" onclick="changeRole(' + rolesList[i]['id'] + ')">' + rolesList[i]['title'] + '</a></li>');
}

function setModulesMenu() {
    $('#menu').html('');
    var modules = AJAXRequest(baseURL + '/getMyModules', globalSysRequestMethod, '')['data'];
    $('#menu').append('<li class="nav-header">Navigation</li>');
    $('#menu').append(createMenu(modules, 1));
    $('#menu').append('<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>');
    Menu.init();
}



function changeCompany(id) {
    var res = AJAXRequest(baseURL + '/changeCompany', globalSysRequestMethod, {'id' : id});
    if (res['status'] == true) {
        setCompanySelect();
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



function setModule(id) {
    var module = AJAXRequest('/getModule', globalSysRequestMethod, '');
}




function createMenu(modules, step) {
    var x = '';
    if (step == 1) {
        var has_child = 0;
        for (var key in modules) {
            has_child = modules[key]['has_child'];

            x += has_child ? '<li class="has-sub">' : '<li>';

            x += has_child ? '<a href="javascript:;">' : '<a href="javascript:;" onclick="setModule(' + modules[key]['id'] + ')">';

            x += has_child ? '<b class="caret pull-right"></b>' : '';
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
            x += has_child ? '<a href="javascript:;">' : '<a href="javascript:;" onclick="setModule(' + modules[key]['id'] + ')">';
            x += has_child ? '<b class="caret pull-right"></b>' : '';
            x += modules[key]['title'];
            x += '</a>';

            x += has_child ? createMenu(modules[key]['sub_module'], 2) : '';

            x += '</li>';

        }
        x += '</ul>';

    }

    return x;
}

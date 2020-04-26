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

function setOrganSelect() {
    $('#ul-organ_list').html('');
    var organsList = AJAXRequest(baseURL + '/getMyOrgans', globalSysRequestMethod, '')['data'];
    var currentOrgan = {};
    currentOrgan['id'] = 0;
    currentOrgan = AJAXRequest(baseURL + '/getMyCurrentOrgan', globalSysRequestMethod, '')['data'];
    for (var i = 0; i < organsList.length; i++)
        $('#ul-organ_list').append('<li ' + (organsList[i]['id'] == currentOrgan['id'] ? 'class="active"' : '') + '><a href="javascript:;" onclick="changeOrgan(' + organsList[i]['id'] + ')">' + organsList[i]['title'] + '</a></li>');
}

function setRoleSelect() {
    $('#ul-role_list').html('');
    var rolesList = AJAXRequest(baseURL + '/getMyRolesOfCurrentOrgan', globalSysRequestMethod, '')['data'];
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

    //TODO make better call for handle menu
    handleSidebarMenu();
    handleMobileSidebarToggle();
    handleSidebarMinify();
    handleMobileSidebar();
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



function setModule(id) {
    var module = AJAXRequest(baseURL + '/getModule', globalSysRequestMethod, {id: id});
    console.log(module);
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

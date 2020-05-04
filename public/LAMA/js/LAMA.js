function AJAXRequest(url, method, data, type = 3) {
    /**
     * type = 1 : little notification modal
     * type = 2 : big notification modal
     * type = 3 : no action
     * type = 4 : little notification message
     * type = 5 : big notification message
     * type = 6 : if status is false little notification error message
     * type = 7 : if status is false big notification error message
     * type = 8 : for modules
     * @type {{}}
     */
    //TODO page loader
        //console.log(data);
    var response = {};
    $.ajax({
        url: url,
        method: method,
        data: data,
        async: false,
        success: function (data) {
            response = data;
        },
        error: function () {
            //TODO
        }
    });

    if (type == 1) {//type 1 : handle errors and pass standard data
        errorsManagement(response['messageCode'], response['type'], 1);
        return {data: response['data'], status: response['status']};
    } else if (type == 2) {
        errorsManagement(response['messageCode'], response['type'], 2);
        return {data: response['data'], status: response['status']};
    } else if (type == 3) {//type 2 : pass all data without handle errors
        return response;
    } else if (type == 4) {
        errorsManagement(response['messageCode'], response['type'], 1);
        return {data: response['data'], status: response['status']};
    }else if (type == 5) {
        //TODO
    }else if (type == 6) {
        if (response['type'] == 2)
            errorsManagement(response['messageCode'], response['type'], 1);
        return {data: response['data'], status: response['status']};
    } else if (type == 7) {
        if (response['type'] == 2)
            errorsManagement(response['messageCode'], response['type'], 2);
        return {data: response['data'], status: response['status']};
    } else if (type == 8) {
        if (response['type'] == 2)
            errorsManagement(response['messageCode'], response['type'], 2);
        return response;
    }
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
    var res = AJAXRequest(baseURL + '/changeOrgan', globalSysRequestMethod, {'id' : id}, 4);
    if (res['status'] == true) {
        SC = res['data']['SC'];
        setOrganSelect();
        setRoleSelect();
        setModulesMenu();

    }
}

function changeRole(id) {
    var res = AJAXRequest(baseURL + '/changeRole', globalSysRequestMethod, {'id' : id}, 4);
    if (res['status'] == true) {
        SC = res['data']['SC'];
        setRoleSelect();
        setModulesMenu();


    }
}

function setModulesMenu() {
    $('#menu').html('');
    var modules = AJAXRequest(baseURL + '/getMyModules', globalSysRequestMethod, '')['data'];
    $('#menu').append('<li class="nav-header">Navigation</li>');
    $('#menu').append(createMenu(modules, 1));
    setModule('dashboard');
    App.initSidebar();
}

function setAdminDetails() {
    var adminDetails = AJAXRequest(baseURL + '/getUserDetails', globalSysRequestMethod, '')['data'];
    $('.username-filed').html(adminDetails['username']);
    $('.name-filed').html(adminDetails['first_name'] + ' ' + adminDetails['last_name']);
    $('.user_avatar-field').attr('src', adminDetails['avatar']);
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

    var data = AJAXRequest(baseURL + '/module/' + sys_title + '/view', globalSysRequestMethod, {'_SC': SC}, 8);
    if (data['messageCode'] != undefined) {
        //TODO handle errors
    } else {
        $('#module-section').html(data);
    }

}


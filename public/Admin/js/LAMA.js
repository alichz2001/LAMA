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
    return response['data'];
}

function setCompanySelect() {
    var companiesList = AJAXRequest(baseURL + '/getMyCompanies', globalSysRequestMethod, '');
    for (var i = 0; i < companiesList.length; i++)
        $('#ul-company_list').append('<li><a href="javascript:;" onclick="changeCompany(' + companiesList[i]['id'] + ')">' + companiesList[i]['title'] + '</a></li>');
}

function setModulesMenu() {
    $('#menu').html('');
    var modules = AJAXRequest(baseURL + '/getMyModules', globalSysRequestMethod, '');
    $('#menu').append('<li class="nav-header">Navigation</li>');
    $('#menu').append(createMenu(modules, 1));
    $('#menu').append('<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>');

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





function setModule(id) {
    var module = AJAXRequest('', globalSysRequestMethod, '');
}

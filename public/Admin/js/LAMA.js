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
    var companiesList = AJAXRequest('/admin/sys/getMyCompanies', 'get', '');
    for (var i = 0; i < companiesList.length; i++)
        $('#ul-company_list').append('<li><a href="javascript:;" onclick="changeCompany(' + companiesList[i]['id'] + ')">' + companiesList[i]['title'] + '</a></li>');
}

function setModulesMenu() {
    var modules = AJAXRequest('/admin/sys/getMyModules', 'get', '');
    var x = '';
    console.log(modules);
    for (var key in modules) {
        var has_child = modules[key]['has_child'];

        x += has_child ? '<li class="has-sub">' : '<li>';
        x += '<a href="javascript:;">';

        x += has_child ? '<b class="caret pull-right"></b>' : '';
        x += '<i class="fa ' + modules[key]['icon'] + '"></i>';
        x += '<span>' + modules[key]['title'] + '</span>';
        x += '</a>';







        x += '</li>';
    }
    console.log(x);
    $('#menu').append(x);

}

function createSections(sectionsArray) {
    var out = '';
    for (var i = 0; i < sectionsArray.length; i++) {
        switch (sectionsArray[i]['type']) {
            case 1:
                out += sectionCreatorPanel(sectionsArray[i]);
                break;

        }
    }
    $('#module-section').append(out);
}

function sectionCreatorPanel(sectionDetails) {
    var out = '';
    out += '<!-- begin col-12 -->\n' +
        '    <div class="col-lg-12" id="section_' + sectionDetails['id'] + '">\n' +
        '        <!-- begin panel -->\n' +
        '        <div class="panel panel-loading panel-inverse">\n' +
        '            <!-- begin panel-heading -->\n' +
        '            <div class="panel-heading">\n' +
        '                <div class="panel-heading-btn">\n' +
        '                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>\n' +
        '                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" onclick="section_' + sectionDetails['id'] + '()"><i class="fa fa-redo"></i></a>\n' +
        '                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>\n' +
        '                </div>\n' +
        '                <h4 class="panel-title">' + sectionDetails['title'] + '</h4>\n' +
        '            </div>\n' +
        '            <!-- end panel-heading -->\n' +
        '\n' +
        '            <!-- begin panel-body -->\n' +
        '            <div class="panel-body" id="section-body_' + sectionDetails['id'] + '">\n' +
        '                <div class="panel-loader"><span class="spinner-small"></span></div>' +
        '            </div>\n' +
        '            <!-- end panel-body -->\n' +
        '        </div>\n' +
        '        <!-- end panel -->\n' +
        '    </div>\n' +
        '    <!-- end col-12 -->';
    return out;
}

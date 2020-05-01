function errorsManagement(errorCode, messageType, modalType) {
    var message = translateMessage(errorCode, 'fa');
    console.log(message);
    //message type word
    var MTW = {
        1: 'success',
        2: 'error',
        3: 'warning'
    };
    //message color
    var MC = {
        1: 'green',
        2: 'red',
        3: 'yellow'
    };
    if (modalType == 1) {
        iziToast.show({
            color: MC[messageType],
            title: message['title'],
            message: message['text']
        });
    } else if (modalType == 2) {
        swal({
            title: message['title'],
            text: message['text'],
            icon: MTW[messageType],
            buttons: {
                confirm: {
                    text: 'ok',
                    value: true,
                    visible: true,
                    className: 'btn btn-primary',
                    closeModal: true
                }
            }
        });
    }
}


var translateMessage = function (errorCode, lang) {
    switch (lang) {
        case 'fa':
            switch (errorCode) {
                case 20000:
                    return {
                        'title': '',
                        'text': 'عملیات با موفقیت انجام شد'
                    };
                    break;
                case 20020:
                    return {
                        'title': 'تغییر ارگان',
                        'text': 'ارگان با موفقیت تغییر پیدا کرد'
                    };
                    break;
                case 20021:
                    return {
                        'title': 'تغییر نقش',
                        'text': 'نقش با موفقیت تغییر پیدا کرد'
                    };
                    break;










                case 40007:
                    return {
                        'title': 'مشکل سرور',
                        'text' : 'ماژول مورد نظر یافت نشد'
                    };
                    break;
                case 40040:
                    return {
                        'title': 'مشکل دسترسی',
                        'text' : 'شما به این ارگان دسترسی ندارید'
                    };
                    break;
                case 40041:
                    return {
                        'title': 'مشکل دسترسی',
                        'text' : 'شما به این نقش دسترسی ندارید'
                    };
                    break;
                case 40043:
                    return {
                        'title': 'مشکل دسترسی',
                        'text' : 'شما در این ارگان هیچ نقشی ندارید'
                    };
                    break;
                default:
                    return {
                        'title': '',
                        'text': 'خطای غیر مترقبه. مجددا اقدام نمایید'
                    };
                    break;
            }
            break;
    }
};

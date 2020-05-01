var translateMessage = function (errorCode, lang) {
    switch (lang) {
        case 'fa':
            switch (errorCode) {
                case 20000: return 'عملیات با موفقیت انجام شد'; break;
                default: return 'خطای غیر مترقبه'; break;
            }
            break;
    }
};

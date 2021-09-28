$.extend($.fn.dataTable, {
    language: {
        processing: '<div class="spinner"><div class="spinner-db"></div><div class="spinner-arrow"></div></div>'
    }
});

$(document).ready(() => {
    //path per far caricare l'svg prima che inizi le richieste
    $('#tbl_toblerone_report').show();
    $('#tbl_report_spinner').hide();
});

const ask = (action, params = {}) => new Promise((resolve, reject) => {
    $.get('../../content_manager_better/src/php/api.php', Object.assign({}, params, {
        action: action
    }), (data) => {
        if (data.error) {
            console.log(data.error);
        } else {
            resolve(data.response);
        }
    });
});
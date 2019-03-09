global.jQuery = $ = require('jquery');
// require('jquery')
require('bootstrap')

require('admin-lte/plugins/iCheck/icheck.min')

$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
});
try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

require('select2')
require('jquery-ui')
require('bootstrap-daterangepicker')
require('bootstrap-datepicker')
require('moment')
require('slimscroll')
require('fastclick')
require('admin-lte')

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
    $('.select2').select2();
});
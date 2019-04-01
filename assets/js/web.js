const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;

require('bootstrap-sass');

require('../lib/argob-poncho/dist/js/poncho.min')

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
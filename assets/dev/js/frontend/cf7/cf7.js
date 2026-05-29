jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction("frontend/element_ready/rael_cf_styler.default", function($scope, $) {

        if ( 'undefined' == typeof $scope )
            return;

        var	raelCf7SelectFields = $scope.find('select:not([multiple])'),
            raelCf7Loader = $scope.find('span.ajax-loader');


        raelCf7SelectFields.wrap( "<span class='rael-cf7-select-custom'></span>" );

        raelCf7Loader.wrap( "<div class='rael-cf7-loader-active'></div>" );

        var raelCf7event = document.querySelector( '.wpcf7' );

        if( null !== raelCf7event ) {
            raelCf7event.addEventListener( 'wpcf7submit', function( event ) {
                var raelCf7ErrorFields = $scope.find('.wpcf7-not-valid-tip');
                raelCf7ErrorFields.wrap( "<span class='rael-cf7-alert'></span>" );
            }, false );
        }
    });
});
(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/technocy-header-group.default', ($scope) => {

            let $button_side = $scope.find('.site-header-button .button-content');
            let $button_active = $scope.find('.header-button-canvas');
            let $button_closs = $scope.find('.button-side-overlay, .button-side-heading .close-button-side');

            $button_closs.on('click', function (e) {
                e.preventDefault();
                $button_active.removeClass('active');
            });

            // Setup
            $button_side.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $button_active.toggleClass('active');
            });
        });
    });

})(jQuery);



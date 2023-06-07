(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/technocy-video-popup.default', ($scope) => {
            $scope.find('.technocy-video-popup a.elementor-video-popup').magnificPopup({
                type: 'iframe',
                removalDelay: 500,
                midClick: true,
                closeBtnInside: true,
                callbacks: {
                    beforeOpen: function () {
                        this.st.mainClass = this.st.el.attr('data-effect');
                    }
                },
            });
        });
    });
})(jQuery);

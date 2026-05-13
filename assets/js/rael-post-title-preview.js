(function($) {
    var checkInterval = setInterval(function() {
        if (window.elementor && window.elementor.settings && window.elementor.settings.page) {
            clearInterval(checkInterval);
            
            function applyHideTitleCSS(isHidden) {
                $('.elementor-widget-rael-theme-post-title').each(function() {
                    var $widget = $(this);
                    
                    if (isHidden) {
                        $widget.find('.elementor-heading-title').hide();
                        $widget.addClass('rael-title-hidden');
                        
                        var $container = $widget.find('.elementor-widget-container');
                        if ($container.length && !$widget.find('.rae-hidden-message').length) {
                            $container.append('<div class="elementor-alert elementor-alert-info rae-hidden-message">Title is hidden via Post Settings → Hide Title.</div>');
                        }
                    } else {
                        $widget.find('.elementor-heading-title').show();
                        $widget.removeClass('rael-title-hidden');
                        $widget.find('.rae-hidden-message').remove();
                    }
                });
            }
            
            var settings = window.elementor.settings.page.getSettings();
            applyHideTitleCSS(settings.settings.hide_title === 'yes');
            
            window.elementor.settings.page.addChangeCallback('hide_title', function(value) {
                applyHideTitleCSS(value === 'yes');
            });
        }
    }, 500);
})(jQuery);
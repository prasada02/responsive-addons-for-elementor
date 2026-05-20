/**
 * Insert RAE Logo in elementor Edit Page in Elementor Bar.
 */

(function() {
    'use strict';

    // Flag to prevent duplicate button creation
    let raelButtonAdded = false;

    // Helper function to add button to Elementor editor bar using jQuery.
    function addRAELButtonToElementorBar() {
        // Prevent duplicate rael buttons.
        if (raelButtonAdded) {
            return;
        }
    
        const $ = window.jQuery;
        if (!$) {
            return;
        }

        // Wait for Elementor to be ready.
        setTimeout(() => {

            if ($('#rael-upsell-button').length > 0) {
                raelButtonAdded = true;
                return;
            }

            const targetContainer = $('#elementor-editor-wrapper-v2 header .MuiGrid-root:nth-child(3) .MuiStack-root');
            
            if (targetContainer.length) {

                const existingButton = targetContainer.find('button').first();
                const buttonClasses = existingButton.length ? existingButton.attr('class') : 'MuiButtonBase-root MuiButton-root MuiButton-text MuiButton-textPrimary MuiButton-sizeMedium MuiButton-textSizeMedium';

                // Create rael upsell button wrapper.
                const raelButtonWrapper = $('<div class="rael-upsell-icon-root" id="rael-upsell-dashboard-button"></div>');
                const buttonContainer = $('<div class="relative"></div>');
                
                // Create rael upsell button with plugin icon.
                const iconUrl = window.raelElementorUpsellIcon?.iconUrl
                const raelUpsellButton = $(`
                    <button type="button" class="${buttonClasses}" 
                            aria-label="Responsive Addons for Elementor Dashboard" 
                            tabindex="0">
                        <img src="${iconUrl}" 
                             width="22" height="22" >
                    </button>
                `).on('click', function() {
                    // Redirect to RAE Dashboard.
                    window.open('/wp-admin/admin.php?page=rael_getting_started', '_blank');
                });

                function getTooltipText() {                    
                    return window?.raelElementorUpsellIcon?.strings?.rael;
                }

                raelUpsellButton.hover(
                    function() {
                        // Show tooltip.
                        const tooltipText = getTooltipText();
                        $(this).attr('title', tooltipText);
                    },
                    function() {
                        // Hide tooltip.
                        $(this).removeAttr('title');
                    }
                );

                buttonContainer.append(raelUpsellButton);
                raelButtonWrapper.append(buttonContainer);
                
                // Insert after the last button.
                targetContainer.children().last().after(raelButtonWrapper);
                
                raelButtonAdded = true;
            }
        }, 500);
    }

    // Initialize when Elementor is ready.
    function initializeRaelUpsellButton() {
        // Check if the window is Elementor Editor.
        if (!window.elementor) {
            return;
        }

        addRAELButtonToElementorBar();
    }

    window.addEventListener('elementor/frontend/init', () => {
        setTimeout(initializeRaelUpsellButton, 200);
    });

    // Also try direct initialization.
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(initializeRaelUpsellButton, 300);
        });
    } else {
        setTimeout(initializeRaelUpsellButton, 300);
    }

    // Fallback with window load.
    window.addEventListener('load', () => {
        setTimeout(initializeRaelUpsellButton, 500);
    });

})();
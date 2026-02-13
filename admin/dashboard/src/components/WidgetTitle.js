const WidgetTitle = ({ title }) => {

    console.log(title);

    let widgetTitle = title.replace(/^woocommerce-theme-/, '');

    // Handle special cases FIRST
    switch (widgetTitle) {
        case 'cf-styler':
            widgetTitle = 'Contact Form Styler';
            break;
        case 'gf-styler':
            widgetTitle = 'Gravity Forms Styler';
            break;
        case 'mc-styler':
            widgetTitle = 'MailChimp Styler';
            break;
        case 'wpf-styler':
            widgetTitle = 'WP Form Styler';
            break;
        default:
            widgetTitle = widgetTitle.replaceAll('-', ' ');
    }

    return (
        <span className="text-sm font-medium text-slate-800 capitalize">
            {widgetTitle}
        </span>
    );
};

export default WidgetTitle;

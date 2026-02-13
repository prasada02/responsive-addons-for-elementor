import { raelWidgetsIcons } from "../../../js/rael-widget-icons";

const WidgetIcon = ({ widget }) => {

    let icon = widget?.replace(/-/g, '_');

    // if ( icon === 'responsive_block_editor_addons_cta' ) {
    //     icon = 'call_to_action';
    // }
    // if ( icon === 'responsive_block_editor_addons_post_grid' ) {
    //     icon = 'post_grid';
    // }
    // if ( icon === 'image_boxes_block' ) {
    //     icon = 'image_boxes';
    // }
    
    return (
        <span>{raelWidgetsIcons[icon]}</span>
    )
}

export default WidgetIcon;
import { raelWidgetsIcons } from "../../../js/rael-widget-icons";

const WidgetIcon = ({ widget }) => {

    let icon = widget?.replace(/-/g, '_');
    
    return (
        <span>{raelWidgetsIcons[icon]}</span>
    )
}

export default WidgetIcon;
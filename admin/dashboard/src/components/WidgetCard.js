import { __ } from "@wordpress/i18n";
// import Icons from "../icons";
// import WidgetIcon from "./WidgetIcon";
import { ToggleControl } from "@wordpress/components";
import { WidgetContext } from "../WidgetContext";
import { useContext } from "react";

const WidgetCard = ({ data }) => {

    const { key, category, title, status, demo } = data;

    const { handleToggle } = useContext(WidgetContext);

    return (
        <div key={key} className={`flex justify-between items-center border border-slate-100 bg-white rounded-md py-4.5 px-3.5 transition-shadow hover:[box-shadow:0px_10px_15px_-3px_rgba(0,0,0,0.1)] rael-widget-category-card rael-widget-category-${category} ${category === 'extensions' ? 'relative' : ''}`}>
            {category === 'extensions' && <span className="absolute top-0 left-0 uppercase text-xs leading-4 font-normal text-slate-600 bg-gray-200 rounded-md px-1.5 py-0.5">{__( 'Extension', 'responsive-widget-editor-addons' )}</span>}
            <div className="flex items-center gap-2">
                {/* <WidgetIcon widget={key} /> */}
                <span>ICON</span>
                <span className="text-sm font-medium text-slate-800 capitalize">{title.replaceAll('-', ' ')}</span>
            </div>
            <div className="flex items-center gap-2">
                <a href={demo} target="_blank"><span className="flex w-4.5">Arrow</span></a>
                <ToggleControl
                    className={'rael-widget-toggle'}
                    __nextHasNoMarginBottom
                    checked={status}
                    onChange={() => handleToggle(key)}
                />
            </div>
        </div>
    )
}

export default WidgetCard
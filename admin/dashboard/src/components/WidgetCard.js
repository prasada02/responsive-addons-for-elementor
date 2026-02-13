import { __ } from "@wordpress/i18n";
import WidgetIcon from "./WidgetIcon";
import { ToggleControl } from "@wordpress/components";
import { WidgetContext } from "../WidgetContext";
import { useContext } from "react";
import Icons from "../icons";

const WidgetCard = ({ data }) => {

    const { category, title, status, docs } = data;

    const { handleToggle } = useContext(WidgetContext);

    return (
        <div key={title} className={`flex flex-col gap-2 border border-slate-100 bg-white rounded-md py-4.5 px-3.5 transition-shadow hover:[box-shadow:0px_10px_15px_-3px_rgba(0,0,0,0.1)] rael-widget-category-card rael-widget-category-${category} ${category === 'extensions' ? 'relative' : ''}`}>
            {category === 'extensions' && <span className="absolute top-0 left-0 uppercase text-xs leading-4 font-normal text-slate-600 bg-gray-200 rounded-md px-1.5 py-0.5">{__( 'Extension', 'responsive-widget-editor-addons' )}</span>}
            <div className="flex justify-between">
                <WidgetIcon widget={title} />
                <ToggleControl
                    className={'rael-widget-toggle'}
                    __nextHasNoMarginBottom
                    checked={status}
                    onChange={() => handleToggle(title)}
                />
            </div>
            <div className="flex justify-between">
                <span className="text-sm font-medium text-slate-800 capitalize">{title.replaceAll('-', ' ')}</span>
                <a href={docs} target="_blank" className="no-underline"><span className="flex w-4.5">{Icons.arrowDiagonal}</span></a>
            </div>
        </div>
    )
}

export default WidgetCard
import { __ } from "@wordpress/i18n";
import WidgetIcon from "./WidgetIcon";
import WidgetTitle from "./WidgetTitle";
import { ToggleControl } from "@wordpress/components";
import { WidgetContext } from "../WidgetContext";
import { useContext } from "react";
import Icons from "../icons";
import { convertTruthyFalsyValue } from "../Helper";

const WidgetCard = ({ data }) => {

    const { category, title, status, docs } = data;

    const { handleToggle } = useContext(WidgetContext);

    return (
        <div key={title} className={`flex flex-col gap-2 border border-slate-100 bg-white rounded-md py-4.5 px-3.5 transition-shadow hover:[box-shadow:0px_10px_15px_-3px_rgba(0,0,0,0.1)] rael-widget-category-card rael-widget-category-${category}`}>
            <div className="flex justify-between">
                <WidgetIcon widget={title} />
                <ToggleControl
                    className={'rael-widget-toggle'}
                    __nextHasNoMarginBottom
                    checked={convertTruthyFalsyValue(status)}
                    onChange={() => handleToggle(title)}
                />
            </div>
            <div className="flex justify-between">
                <WidgetTitle title={title} />
                <a href={docs} target="_blank" className="no-underline"><span>{Icons.arrowDiagonal}</span></a>
            </div>
        </div>
    )
}

export default WidgetCard
import { __ } from "@wordpress/i18n";
import { useContext, useState } from "react";
import { ToggleControl } from "@wordpress/components";
import { WidgetContext } from "../WidgetContext";
import WidgetIcon from "../components/WidgetIcon";
import WidgetTitle from "../components/WidgetTitle";
import Icons from "../icons";
import { convertTruthyFalsyValue, displayToast } from "../Helper";

const Extensions = () => {

    const { widgetsList, handleToggle, handleToggleAllExtensions } = useContext(WidgetContext);

    const extensionWidgets = widgetsList.filter(
        widget => widget?.category === 'extensions'
    );

    const isDuplicatorOn = widgetsList.filter(
        widget => widget?.category === 'extensions' && widget?.title === 'duplicator' && convertTruthyFalsyValue(widget?.status) === true
    );

    const [showDuplicator, setShowDupliator] = useState(false);

    const areAllExtensionsEnabled = extensionWidgets.length > 0 && extensionWidgets.every(widget =>
        convertTruthyFalsyValue(widget?.status) === true
    );

    return (
        <div className="xl:mx-14 md:mx-15 mt-12 mb-16">
            <div className="flex flex-col gap-3 mt-6 p-3 bg-slate-100 border border-slate-200 rounded-lg">
                <div className="flex items-center justify-between bg-white py-6 px-8 rounded-lg">
                    <span className="text-lg leading-7 font-medium text-slate-800">Extensions</span>
                    <div className="flex items-center gap-3">
                        <ToggleControl
                            className="rael-widget-toggle"
                            __nextHasNoMarginBottom
                            checked={areAllExtensionsEnabled}
                            onChange={handleToggleAllExtensions}
                        />
                        <span className="text-sm font-medium leading-5 text-slate-800">{__('Enable All', 'responsive-addons-for-elementor')}</span>
                    </div>
                </div>
                {widgetsList.map((current) => {
                    if (current?.category !== 'extensions') return null;
                    return (
                        <div className="flex items-center justify-between bg-white py-6 px-8 rounded-lg">
                            <div className="flex items-center gap-4">
                                {current?.title === 'sticky-section' ? <WidgetIcon widget="sticky_section" /> : <WidgetIcon widget="extensions" />}
                                <WidgetTitle title={current?.title} />
                            </div>
                            <div className="flex items-center gap-4.5">
                                <div className="flex items-center gap-3">
                                    {current?.title === 'duplicator' && <div className="flex items-center gap-3">
                                        <span className={current?.status ? 'cursor-pointer' : 'cursor-not-allowed'} onClick={() => setShowDupliator(true)}>{Icons.setting}</span>
                                        <span>|</span></div>}
                                    <a href={current?.docs} target="_blank" className="no-underline"><span className="w-4.5">{Icons.arrowDiagonal}</span></a>
                                </div>
                                <ToggleControl
                                    className="rael-widget-toggle"
                                    __nextHasNoMarginBottom
                                    checked={convertTruthyFalsyValue(current?.status) === true}
                                    onChange={() => handleToggle(current?.title)}
                                />
                            </div>
                        </div>
                    );
                })}
            </div>
            {isDuplicatorOn.length > 0 && showDuplicator && <ShowDuplicatorSetting setShowDupliator={setShowDupliator} />}
        </div>
    )
}

const ShowDuplicatorSetting = ({ setShowDupliator }) => {

    const [selectedPostType, setSelectedPostType] = useState(localize.selected_posttype);

    const saveDuplicator = async () => {
        const formData = new FormData();

        formData.append("action", "rael_save_duplicator_settings");
        formData.append("_nonce", localize.nonce);
        formData.append("post_types", selectedPostType);

        const response = await fetch(localize.ajaxurl, {
            method: "POST",
            body: formData,
        });

        const data = await response.json();

        if (response.ok) {
            displayToast("Settings Saved", "success");
        } else {
            displayToast("Error saving settings", "error");
        }

        return data;

    };


    return (
        <div className="flex items-center justify-center fixed top-0 right-0 bottom-0 left-0 z-9999 p-3 bg-[#00000073] border border-slate-200 rounded-lg">
            <div className="w-125 bg-white rounded-xl p-9 shadow-[0_20px_40px_rgba(0,0,0,0.15)]">
                <div className="w-full flex justify-between items-center mb-4 text-gray-600">
                    <p className="m-0 text-xl">Duplicator</p>
                    <span className="text-2xl cursor-pointer" onClick={() => setShowDupliator(false)}>&times;</span>
                </div>
                <hr />
                <div className="my-8">
                    <label className="text-base font-semibold text-gray-600" htmlFor="rael-duplicator-post-types">{__('Select Post Types', 'responsive-addons-for-elementor')}</label>
                    <select
                        id="rael-duplicator-post-types"
                        className="w-full max-w-full! h-10 mt-2 p-2 border border-slate-300 rounded-md"
                        value={selectedPostType}
                        onChange={(e) => setSelectedPostType(e.target.value)}
                    >
                        <option value="all">All</option>
                        <option value="post">Post</option>
                        <option value="page">Page</option>

                        {Object.entries(localize.all_cpts).map(([key, label]) => (
                            <option key={key} value={key}>
                                {label}
                            </option>
                        ))}
                    </select>
                </div>
                <hr />
                <div className="text-right">
                    <button onClick={saveDuplicator} className="mt-4 px-2.5 py-2 bg-[#3858e9] border-0 text-white rounded-md cursor-pointer">{__('Save', 'responsive-addons-for-elementor')}</button>
                </div>
            </div>
        </div>
    );
}

export default Extensions;
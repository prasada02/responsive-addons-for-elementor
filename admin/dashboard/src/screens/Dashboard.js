import { __ } from "@wordpress/i18n";
import { useNavigate } from 'react-router-dom';
import { useContext } from "react";
import { WidgetContext } from "../WidgetContext";
import WidgetCard from "../components/WidgetCard";

const Dashboard = () => {
    return (
        <>
            <HeroSection />
            <WidgetSection />
            {/* <ExtendAndQuickAccess /> */}
            {/* <StarterTemplates /> */}
        </>
    )
}

const HeroSection = () => {
    return (
        <div className="xl:mx-30 md:mx-15 mt-8 mb-16 rounded-lg bg-linear-to-r from-[#080084] to-[#2563EB]">
            <div className="flex flex-col gap-6 py-15 px-6 sm:py-14 sm:px-14 pl-15">
                <p className="text-white font-bold text-5xl sm:text-4xl md:text-5xl leading-tight m-0">{__('Welcome to Responsive Addons for Elementor', 'responsive-addons-for-elementor')}</p>
                <p className="max-w-175 text-white font-medium text-sm leading-relaxed m-0">{__('Create stunning WordPress websites with our intuitive block builder. Design beautiful pages, explore ready-made templates, and customize everything to match your vision. Get started in seconds!', 'responsive-addons-for-elementor')}</p>
                <p className="m-0">
                    <button onClick={() => window.location.href = localize?.pageurl} className="flex items-center gap-1 py-2.5 px-5 text-blue-600 bg-white rounded-md font-medium"> {__('Create a Page', 'responsive-addons-for-elementor')}
                    </button>
                </p>
            </div>
        </div>
    )
};

const WidgetSection = () => {

    const navigate = useNavigate();

    const { widgetsList, activeWidgetsCount, inactiveWidgetsCount } = useContext(WidgetContext);

    return (
        <div className="xl:mx-30 md:mx-15 mb-16">
            <div className="flex justify-between">
                <div className="flex items-center gap-5">
                    <p className="text-2xl font-medium m-0">{__('Widgets', 'responsive-addons-for-elementor')}</p>
                    <div className="flex items-center gap-3">
                        <span className="flex items-center rounded-3xl border border-blue-300 text-xs font-normal text-blue-500 bg-blue-100 px-2.5 py-1">{__('Total Widgets', 'responsive-addons-for-elementor')} {widgetsList.length}</span>
                        <span className="flex items-center rounded-3xl border border-green-300 text-xs font-normal text-green-800 bg-green-100 px-2.5 py-1">{__('Active', 'responsive-addons-for-elementor')} {activeWidgetsCount}</span>
                        <span className="flex items-center rounded-3xl border border-red-300 text-xs font-normal text-red-500 bg-red-100 px-2.5 py-1">{__('Inactive', 'responsive-addons-for-elementor')} {inactiveWidgetsCount}</span>
                    </div>
                </div>
                <div>
                    <button onClick={() => navigate('/widgets')} className="cursor-pointer rounded-md border border-blue-600 text-blue-600 hover:bg-blue-100 text-sm font-medium px-5 py-2">{__('View All', 'responsive-addons-for-elementor')}</button>
                </div>
            </div>
            <p className="font-normal text-base text-desc mt-2 mb-6">{__('Manage which widgets are enabled for your website', 'responsive-addons-for-elementor')}</p>
            <CardSection />
        </div>
    )
};

const CardSection = () => {

    const specificWidgets = ['advanced-tabs', 'dual-color-header', 'flip-box', 'google-map', 'icon-box', 'image-gallery', 'media-carousel', 'posts', 'pricing-table', 'stacking-cards', 'testimonial-slider', 'timeline'];

    const { widgetsList } = useContext(WidgetContext)

    const showWidgets = widgetsList.filter(item => specificWidgets.includes(item.title));

    return (
        <div className="mt-8 mb-16">
            <p>wefwdwd</p>
            <div className="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                {showWidgets.map((current) => <WidgetCard data={current} />)}
            </div>
        </div>
    )
}

export default Dashboard
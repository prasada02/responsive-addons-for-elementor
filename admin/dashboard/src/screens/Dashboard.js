import { __ } from "@wordpress/i18n";
import { useNavigate } from 'react-router-dom';
import { useContext, useState } from "react";
import { WidgetContext } from "../WidgetContext";
import WidgetCard from "../components/WidgetCard";
import InstallButton from "../components/InstallButton";
import Icons from "../icons";

const Dashboard = () => {
    return (
        <>
            <HeroSection />
            <WidgetSection />
            <ExtendAndQuickAccess />
            <StarterTemplates />
        </>
    )
}

const HeroSection = () => {
    return (
        <div className="xl:mx-30 md:mx-15 mt-8 mb-16 rounded-lg bg-[linear-gradient(256.02deg,#080084_19.96%,#2563EB_90.75%)]">
            <div className="flex flex-col gap-6 py-15 px-6 sm:py-14 sm:px-14 pl-15">
                <p className="text-white font-bold text-5xl sm:text-4xl md:text-5xl leading-tight m-0">{__('Welcome to Responsive Addons for Elementor', 'responsive-addons-for-elementor')}</p>
                <p className="max-w-175 text-blue-50 font-medium text-sm leading-relaxed m-0">{__('Create stunning WordPress websites with our intuitive block builder. Design beautiful pages, explore ready-made templates, and customize everything to match your vision. Get started in seconds!', 'responsive-addons-for-elementor')}</p>
                <p className="m-0">
                    <button onClick={() => window.location.href = localize?.pageurl} className="flex items-center gap-1 py-2.5 px-3.5 text-blue-500 leading-5 cursor-pointer bg-white rounded-md font-medium border-0">{Icons.createPage} {__('Create a Page', 'responsive-addons-for-elementor')}
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
            <p className="font-normal text-base text-desc text-[#4B5563] mt-2 mb-6">{__('Manage which widgets are enabled for your website', 'responsive-addons-for-elementor')}</p>
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
            <div className="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 p-3 bg-slate-100 border border-slate-200 rounded-lg">
                {showWidgets.map((current) => <WidgetCard data={current} />)}
            </div>
        </div>
    )
}

const ExtendAndQuickAccess = () => {

    const navigate = useNavigate();

    const [rplusText, setRplusText] = useState(localize?.rst_status);
    const [rbeaText, setRbeaText] = useState(localize?.rbea_status);
    const [themeText, setThemeText] = useState(localize?.responsive_status);

    return (
        <div className="xl:flex lg:block justify-between xl:mx-30 md:mx-15 mt-8 mb-16 gap-12">
            <div className="xl:w-2/3 lg:w-full">
                <p className="font-medium text-2xl m-0">{__('Extend Your Website', 'responsive-addons-for-elementor')}</p>
                <p className="font-normal text-base text-desc mt-2 mb-6">{__("Powerful tools to enhance your site's functionality", 'responsive-addons-for-elementor')}</p>
                <div className="grid md:grid-cols-2 gap-6 w-full p-3 bg-slate-100 border border-slate-200 rounded-md">
                    <PluginCard title={__('Starter Templates', 'responsive-addons-for-elementor')} description={__('150+ Ready to Import Designer-Made Website Starter Templates.', 'responsive-addons-for-elementor')} image="rplus_logo">
                        <button onClick={() => navigate('/templates')} className="mt-1.125 py-2.5 px-3.5 border-0 bg-blue-600 hover:bg-blue-900 rounded-md text-white text-sm leading-5 font-medium cursor-pointer">{__('Explore Templates', 'responsive-addons-for-elementor')}</button>
                    </PluginCard>

                    <PluginCard title={__('Responsive Plus', 'responsive-addons-for-elementor')} description={__('Get Advanced modules: Site Builder, Fonts, WooCommerce, and more.', 'responsive-addons-for-elementor')} image="rplus_logo">
                        <InstallButton
                            type="plugin"
                            status={localize?.rst_status}
                            nonce={localize.rst_nonce}
                            redirect={localize.rst_redirect}
                            buttonText={rplusText}
                            setButtonText={setRplusText}
                            slug="responsive-add-ons"
                        />
                    </PluginCard>

                    <PluginCard title={__('Responsive Blocks', 'responsive-addons-for-elementor')} description={__('50+ Blocks to Enhance Your WordPress Block Editor Experience.', 'responsive-addons-for-elementor')} image="rbea_logo">
                        <InstallButton
                            type="plugin"
                            status={localize?.rbea_status}
                            nonce={localize.rbea_nonce}
                            redirect={localize.rbea_redirect}
                            buttonText={rbeaText}
                            setButtonText={setRbeaText}
                            slug="responsive-block-editor-addons"
                        />
                    </PluginCard>

                    <PluginCard title={__('Responsive Theme', 'responsive-addons-for-elementor')} description={__('Craft Stunning Websites Effortlessly with the Responsive Theme.', 'responsive-addons-for-elementor')} image="responsive_logo">
                        <InstallButton
                            type="theme"
                            status={localize?.responsive_status}
                            nonce={localize.responsive_nonce}
                            redirect={localize.responsive_redirect}
                            buttonText={themeText}
                            setButtonText={setThemeText}
                            slug="responsive"
                        />
                    </PluginCard>
                </div>
            </div>
            <div className="xl:w-1/3 lg-w-full max-xl:mt-8">
                <p className="font-medium text-2xl m-0">{__('Quick Access', 'responsive-addons-for-elementor')}</p>
                <p className="font-normal text-base text-desc mt-2 mb-6">{__('Helpful resources & links', 'responsive-addons-for-elementor')}</p>
                <div className="flex flex-col gap-3 p-3 bg-slate-100 rounded-md border border-slate-200">
                    <div className="flex gap-5 i p-3.5 bg-white rounded-md">
                        <span className="flex items-center self-start p-2.5 rounded-md border border-green-500">{Icons.star}</span>
                        <div>
                            <a href={localize.review_link} target="_blank" className="text-lg leading-7 font-medium text-desc text-[#4B5563] no-underline">{__('Rate Us', 'responsive-addons-for-elementor')}</a>
                            <p className="text-sm leading-5 font-normal text-desc m-0">{__('Share your experience', 'responsive-addons-for-elementor')}</p>
                        </div>
                    </div>
                    <div className="flex gap-5 p-3.5 bg-white rounded-md">
                        <span className="flex items-center self-start p-2.5 rounded-md border border-yellow-500">{Icons.community}</span>
                        <div>
                            <a href="https://www.facebook.com/groups/responsive.theme" target="_blank" className="text-lg leading-7 font-medium text-desc text-[#4B5563] no-underline">{__('Join the Community', 'responsive-addons-for-elementor')}</a>
                            <p className="text-sm leading-5 font-normal text-desc m-0">{__('Connect with other users', 'responsive-addons-for-elementor')}</p>
                        </div>
                    </div>
                    <div className="flex gap-5 p-3.5 bg-white rounded-md">
                        <span className="flex items-center self-start p-2.5 rounded-md border border-blue-200">{Icons.help}</span>
                        <div>
                            <a href="https://wordpress.org/support/plugin/responsive-addons-for-elementor/" target="_blank" className="text-lg leading-7 font-medium text-blue-500 no-underline">{__('Support', 'responsive-addons-for-elementor')}</a>
                            <p className="text-sm leading-5 font-normal text-desc m-0">{__('Get help from our support team', 'responsive-addons-for-elementor')}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

const PluginCard = ({ title, description, image, children }) => {
    return (
        <div className="p-6 bg-white rounded-md transition-shadow hover:[box-shadow:0px_10px_15px_-3px_rgba(0,0,0,0.1)]">
            <div className="flex justify-between items-start">
                <img className="w-12.5 h-12.5" src={localize.raelurl + 'admin/images/' + image + '.svg'} alt="Responsive Logo" />
                <span className="py-1 px-2.5 text-xs leading-4 font-medium text-green-800 bg-green-50 border border-green-300 rounded cap">{__('Free', 'responsive-addons-for-elementor')}</span>
            </div>
            <p className="mt-1.125 mb-2 text-base leading-6 font-medium">{title}</p>
            <p className="text-sm leading-5 font-normal">{description}</p>
            {children}
        </div>
    );
}

const StarterTemplates = () => {

  const navigate = useNavigate();

  const templates = ['Real Estate', 'Business', 'Jewellery Shop', 'Interior Design Firm'];

  return (
    <div className="xl:mx-30 md:mx-15 mt-8 mb-16">
      <div className="flex justify-between mb-6">
        <div>
          <p className="text-2xl leading-8 font-medium m-0">{__('Starter Templates', 'responsive-addons-for-elementor')}</p>
          <p className="mt-2 text-base leading-6 font-normal text-desc">{__('Pre-designed templates to kickstart your website in seconds', 'responsive-addons-for-elementor')}</p>
        </div>
        <button onClick={() => navigate('/templates')} className="rounded-md border border-blue-600 text-blue-600 hover:bg-blue-100 text-sm font-medium px-5 py-2 self-baseline cursor-pointer">{__('View All Templates', 'responsive-addons-for-elementor')}</button>
      </div>
      <div className="flex justify-center gap-6">
        {templates?.map((template, index) => (
          <div className="bg-white border border-slate-200 rounded-md transition-shadow hover:[box-shadow:0px_10px_10px_-5px_rgba(0,0,0,0.04)]">
            <img className="w-full" src={localize.raelurl + `admin/images/template${index + 1}.jpg`} alt={template} />
            <p className="py-6 pl-6 text-base leading-6 font-normal text-black">{template}</p>
          </div>
        ))}
      </div>
    </div>
  );
}

export default Dashboard
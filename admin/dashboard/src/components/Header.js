import { __ } from "@wordpress/i18n";
import { useNavigate, useLocation } from "react-router-dom";

const Header = () => {
    const navigate = useNavigate();
    const location = useLocation();

    const tabs = [
        { label: __("Dashboard", "responsive-addons-for-elementor"), path: "/" },
        { label: __("Widgets", "responsive-addons-for-elementor"), path: "/widgets" },
        { label: __("Extensions", "responsive-addons-for-elementor"), path: "/extensions" },
        { label: __("Theme Builder", "responsive-addons-for-elementor"), external: true },
        { label: __("Settings", "responsive-addons-for-elementor"), path: "/settings" },
        {
            label: __("Starter Templates", "responsive-addons-for-elementor"),
            path: "/templates",
            conditional: true,
        },
    ];

    const handleNavigation = (tab) => {
        if (tab.external) {
            window.location.href = localize?.themebuilderurl;
            return;
        }

        if (tab.conditional) {
            localize?.rst_status !== "activated"
                ? navigate(tab.path)
                : (window.location.href = localize?.rst_redirect);
            return;
        }

        navigate(tab.path);
    };

    return (
        <div className="bg-white border-b border-b-blue-100">
            <div className="mx-auto xl:px-14 md:px-15">
                <div className="flex justify-between">
                    <div className="flex items-center w-10/12 gap-6">
                        <img
                            className="rael-cyberchimps-logo"
                            src={`${localize?.raelurl}admin/images/rael-logo.svg`}
                            alt="RAEL Logo"
                        />

                        <div className="flex w-full md:flex-wrap xl:flex-nowrap">
                            {tabs.map((tab) => {
                                const isActive =
                                    tab.path && location.pathname === tab.path;

                                return (
                                    <div
                                        key={tab.label}
                                        onClick={() => handleNavigation(tab)}
                                        className={`hover:bg-sky-100 cursor-pointer ${
                                            isActive ? "rael-active-tab" : ""
                                        }`}
                                    >
                                        <p className="text-gray-600 text-base font-medium my-6 px-5">
                                            {tab.label}
                                        </p>
                                    </div>
                                );
                            })}
                        </div>
                    </div>

                    <div className="flex w-4/12 items-center justify-end">
                        <div className="border border-slate-200 rounded-md p-3">
                            <p className="text-gray-400 font-medium text-sm m-0">
                                v{localize?.rael_version}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Header;

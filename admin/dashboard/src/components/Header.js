import { __ } from "@wordpress/i18n";
import { useNavigate, useLocation } from 'react-router-dom';

const Header = () => {

    const navigate = useNavigate();
    const location = useLocation();

    return (
        <div className="bg-white border-b border-b-blue-100">
            <div className="mx-auto xl:px-14 md:px-15">
                <div className="flex justify-between">
                    <div className="flex items-center w-8/12 gap-6">
                        <img className="rael-cyberchimps-logo" src={localize?.raelurl + 'admin/images/rael-logo.svg'} />
                        <div className="flex w-full">
                            <div onClick={() => navigate('/')} className={`hover:bg-sky-100 ${location.pathname === '/' ? 'rael-active-tab' : ''} cursor-pointer`}><p className="text-gray-600 text-base font-medium my-6 px-5">{__('Dashboard', 'responsive-addons-for-elementor')}</p></div>
                            <div onClick={() => navigate('/widgets')} className={`hover:bg-sky-100 ${location.pathname === '/widgets' ? 'rael-active-tab' : ''} cursor-pointer`}><p className="text-gray-600 text-base font-medium my-6 px-5">{__('Widgets', 'responsive-addons-for-elementor')}</p></div>
                            <div onClick={() => navigate('/extensions')} className={`hover:bg-sky-100 ${location.pathname === '/extensions' ? 'rael-active-tab' : ''} cursor-pointer`}><p className="text-gray-600 text-base font-medium my-6 px-5">{__('Extensions', 'responsive-addons-for-elementor')}</p></div>
                            <div onClick={() => navigate('/settings')} className={`hover:bg-sky-100 ${location.pathname === '/settings' ? 'rael-active-tab' : ''} cursor-pointer`}><p className="text-gray-600 text-base font-medium my-6 px-5">{__('Settings', 'responsive-addons-for-elementor')}</p></div>
                            <div onClick={() => localize?.isRSTActivated !== 'activated' ? navigate('/templates') : window.location.href = localize?.rst_redirect} className={`hover:bg-sky-100 ${location.pathname === '/templates' ? 'rael-active-tab' : ''} cursor-pointer`}><p className="text-gray-600 text-base font-medium my-6 px-5">{__('Starter Templates', 'responsive-addons-for-elementor')}</p></div>
                        </div>
                    </div>
                    <div className="flex w-4/12 items-center justify-end">
                        <div className="border border-slate-200 rounded-md p-3">
                            <p className="text-gray-400 font-medium text-sm m-0">v{localize?.rael_version}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Header
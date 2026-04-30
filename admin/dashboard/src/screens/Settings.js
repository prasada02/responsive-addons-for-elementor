import { __ } from "@wordpress/i18n";
import { useState, useContext } from "react";
import { WidgetContext } from "../WidgetContext";
import Icons from "../icons";
import { displayToast } from "../Helper";

const Settings = () => {

  const [settingsTab, setSettingsTab] = useState('plugin');

  return (
    <div className="flex xl:mx-14 md:mx-15 my-16">
      <div className="w-1/4 bg-white rounded-tl-3xl p-5">
        <div className="flex flex-col gap-2">
          <div onClick={() => setSettingsTab('plugin')} className={`flex items-center gap-2 px-3 py-4 cursor-pointer rounded-md ${settingsTab === 'plugin' && 'bg-slate-100'}`}>
            {Icons.editor}
            <p className="m-0 text-base leading-6 font-medium">{__('Plugin Settings', 'responsive-addons-for-elementor')}</p>
          </div>
        </div>
      </div>
      <div className="w-3/4 rounded-tr-3xl p-10 bg-slate-100">
        {settingsTab === 'plugin' && <PluginSettings />}
      </div>
    </div>
  )
}

const PluginSettings = () => {

  const { mailchimpapi, setMailchimpapi, googleMapAPI, setGoogleMapAPI, googleMapLanguage, setGoogleMapLanguage, reCaptcha, setReCaptcha, reCaptchaSecret, setReCaptchaSecret } = useContext(WidgetContext);

  const handleAPIvalidate = async () => {
    if (!mailchimpapi) {
      displayToast('Please enter API Key', 'error');
      return;
    }
    const formData = new FormData();
    formData.append('action', 'rael_mailchimp_settings_api_key_validate');
    formData.append('_nonce', localize.nonce);
    formData.append('api_key', mailchimpapi);

    try {
      const res = await fetch(localize.ajaxurl, { method: 'POST', body: formData });
      const data = await res.json();
      if (res.status === 200 && data?.success) {
        displayToast(data?.message || 'API Key is valid', 'success');
      } else {
        displayToast(data?.message || 'API Key is invalid', 'error');
      }
    } catch (e) {
      displayToast('Error validating API Key', 'error');
    }
  };

  return (
    <div className="flex flex-col gap-16">
      <div className="flex flex-col gap-16">
        <SettingsCard
          title={__('RAE Mailchimp Settings', 'responsive-addons-for-elementor')}
          description={__("These setting apply to RAE Mailchimp Styler widget.", 'responsive-addons-for-elementor')}
          link="https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/mailchimp-styler/"
        >
          <div className="flex flex-col gap-3.5">
            <label className="text-lg leading-7 font-medium text-gray-900" htmlFor="rael-mailchimp-api-key">RAE Mailchimp API Setting</label>
            <input
              id="rael-mailchimp-api-key"
              type="text"
              value={mailchimpapi}
              onChange={(e) => setMailchimpapi(e.target.value)}
              className="w-full bg-slate-50! border! border-slate-300! rounded-lg! h-12" />
            <button onClick={handleAPIvalidate} className="rael-not-validated self-start py-2.5 px-3.5 bg-white text-sm leading-5 font-medium text-blue-600 border border-blue-600 rounded-md cursor-pointer">Validate API Key</button>
          </div>
        </SettingsCard>

        <SettingsCard
          title={__('RAE Google Map Settings', 'responsive-addons-for-elementor')}
          description={__("These settings apply to RAE Google Map widget.", 'responsive-addons-for-elementor')}
          link="https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/google-map/"
          childWrapperClassName="flex flex-col gap-6"
        >
          <div className="flex flex-col gap-3.5">
            <label className="text-lg leading-7 font-medium text-gray-900" htmlFor="rael-google-map-api-key">RAE Google Map API Key</label>
            <input value={googleMapAPI} onChange={(e) => setGoogleMapAPI(e.target.value)} id="rael-google-map-api-key" type="text" className="w-full bg-slate-50! border! border-slate-300! rounded-lg! h-12" />
          </div>
          <div className="flex flex-col gap-3.5">
            <label className="text-lg leading-7 font-medium text-gray-900" htmlFor="rael-google-map-local-api-key">RAE Google Map Localization Language</label>
            <select onChange={(e) => setGoogleMapLanguage(e.target.value)} id="rael-google-map-local-api-key" className="w-full max-w-full! bg-slate-50! border! border-slate-300! rounded-lg! h-12">
              <option value="">Default</option>
              {Object.entries(localize.google_map_local_lang || {}).map(([key, label]) => (
                <option key={key} value={key} selected={googleMapLanguage === key}>{label}</option>
              ))}
            </select>
          </div>
        </SettingsCard>

        <SettingsCard
          title={__('RAE Login/Register Form Settings', 'responsive-addons-for-elementor')}
          description={__("These settings apply to RAE Login/Register Form widget.", 'responsive-addons-for-elementor')}
          link="https://cyberchimps.com/docs/responsive-addons-for-elementor/widgets/login-register/"
          childWrapperClassName="flex flex-col gap-6"
        >
          <div className="flex flex-col gap-3.5">
            <label className="text-lg leading-7 font-medium text-gray-900" htmlFor="rael-recaptcha-site-key">RAE Google reCAPTCHA v2 Site key</label>
            <input value={reCaptcha} onChange={(e) => setReCaptcha(e.target.value)} id="rael-recaptcha-site-key" type="text" className="w-full bg-slate-50! border! border-slate-300! rounded-lg! h-12" />
          </div>
          <div className="flex flex-col gap-3.5">
            <label className="text-lg leading-7 font-medium text-gray-900" htmlFor="rael-recaptcha-secret-key">RAE Google reCAPTCHA v2 Secret key</label>
            <input value={reCaptchaSecret} onChange={(e) => setReCaptchaSecret(e.target.value)} id="rael-recaptcha-secret-key" type="text" className="w-full bg-slate-50! border! border-slate-300! rounded-lg! h-12" />
          </div>
        </SettingsCard>
      </div>
      <button onClick={() => saveSetting(mailchimpapi, googleMapAPI, googleMapLanguage, reCaptcha, reCaptchaSecret)} className="self-start py-2.5 px-3.5 text-sm leading-5 font-medium text-white bg-blue-600 border border-blue-600 rounded-md cursor-pointer">Save Settings</button>
    </div>
  );
};

const SettingsCard = ({ title, description, link, children, className = "", childWrapperClassName = "" }) => {
  return (
    <div className={`flex flex-col p-6 bg-white rounded-[10px] ${className}`}>
      <div className="flex flex-col gap-2.5 w-3/4 mb-12">
        <p className="m-0 text-2xl leading-8 font-medium text-gray-900">{title}</p>
        <p className="m-0 text-base leading-6 font-normal text-gray-600 text-setting-desc">{description} {link && <a href={link} target="_blank" className="text-base leading-6 font-normal text-blue-600  no-underline hover:underline">{__('Learn more', 'responsive-addons-for-elementor')}</a>}</p>
      </div>
      <div className={childWrapperClassName}>
        {children}
      </div>
    </div>
  );
};

const saveSetting = async ( mailchimpapi, googleMapAPI, googleMapLanguage, reCaptcha, reCaptchaSecret ) => {
  const formData = new FormData();
  formData.append('action', 'rael_save_api_key_settings');
  formData.append('mailchimpAPIKey', mailchimpapi);
  formData.append('gmapAPIKey', googleMapAPI);
  formData.append('gmapLocalizationLang', googleMapLanguage);
  formData.append('reCaptchaSiteKey', reCaptcha);
  formData.append('reCaptchaSecretKey', reCaptchaSecret);
  formData.append('nonce', localize.nonce);

  try {
    const res = await fetch(localize.ajaxurl, { method: 'POST', body: formData });
    const data = await res.json();
    if (res.status === 200 && data?.success) {
      displayToast('Settings Saved', 'success');
    } else {
      displayToast('Error saving settings', 'error');
    }
  } catch (e) {
    displayToast('Error', 'error');
  }
};

export default Settings;
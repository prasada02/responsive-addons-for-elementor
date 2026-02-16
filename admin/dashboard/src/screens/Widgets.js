import { __ } from "@wordpress/i18n";
import { useState, useContext } from 'react';
import { ToggleControl } from "@wordpress/components";
import WidgetCard from "../components/WidgetCard";
import { WidgetContext } from "../WidgetContext";
import { convertTruthyFalsyValue } from "../Helper";

const Widgets = () => {

  const { widgetsList, toggleAll, handleToggleAll, handleToggleCategory } = useContext(WidgetContext);
  const [showCategory, setShowCategory] = useState('all');
  const [search, setSearch] = useState('');

  const handleShowCategory = (tab) => {
    setShowCategory(tab);
    setSearch('');
  }

  const handleSearch = (value) => {
    setShowCategory('all');
    setSearch(value);
  }

  const widgetsCategories = [
    __('All', 'responsive-addons-for-elementor'),
    __('Content', 'responsive-addons-for-elementor'),
    __('Form', 'responsive-addons-for-elementor'),
    __('Marketing', 'responsive-addons-for-elementor'),
    __('Creativity', 'responsive-addons-for-elementor'),
    __('Woocommerce', 'responsive-addons-for-elementor'),
    __('SEO', 'responsive-addons-for-elementor'),
    __('Theme Builder', 'responsive-addons-for-elementor'),
  ];

  return (
    <div className="xl:mx-14 md:mx-15 mt-12 mb-16 rounded-[20px]">
      <div className="flex justify-between items-center">
        <div className="flex border-b border-b-slate-300">
          {widgetsCategories.map((current) => (
            <div key={current} onClick={() => handleShowCategory(current.toLowerCase())} className={`px-3 py-2.5 text-base leading-6 font-normal text-desc cursor-pointer hover:bg-slate-200 ${showCategory === current.toLowerCase() ? 'rael-active-category' : ''}`}>{current}</div>
          ))}
        </div>
        <div className="relative">
          <input value={search} className="rael-widget-search w-87.5 border! rounded-[10px]! border-slate-200! py-3! px-4! placeholder:text-[#9CA3AF]" onChange={(e) => handleSearch(e.target.value)} autoComplete="off" type="text" name="" id="" placeholder="Search Widgets" />
          <i className="absolute right-2 top-4 bg-white"><span className="dashicons dashicons-search text-[#2563EB]"></span></i>
        </div>
      </div>

      <div className="flex items-center gap-2 mt-16">
        <p className="m-0 text-base leading-6 font-normal text-desc text-[#4B5563]">{__('Toggle All Widgets', 'responsive-addons-for-elementor')}</p>
        <ToggleControl
          className="rael-widget-toggle"
          __nextHasNoMarginBottom
          checked={toggleAll}
          onChange={() => handleToggleAll()}
        />
      </div>

      <div className="[&>div:not(:first-child)]:mt-16">
        {showCategory === 'all' && widgetsCategories
          .filter((cat) => cat !== __('All', 'responsive-addons-for-elementor'))
          .map((categoryLabel) => {

            let categoryKey = categoryLabel === 'Theme Builder' ? 'themebuilder' : categoryLabel.toLowerCase();

            const filteredWidgets = widgetsList.filter((current) => {
              // Skip extensions
              if (current?.category === 'extensions') return false;

              // Match category
              if (current?.category !== categoryKey) return false;

              // Search filter
              if (search !== '' && (!current?.name?.toLowerCase().includes(search) && !current?.title?.toLowerCase().includes(search))) {
                return false;
              }

              return true;
            });

            if (!filteredWidgets.length) return null;

            const isCategoryEnabled = filteredWidgets.length > 0 && filteredWidgets.every(widget =>
              convertTruthyFalsyValue(widget?.status) === true
            );

            return (
              <div
                key={categoryKey}
                className="mt-6 p-3 bg-slate-100 border border-slate-200 rounded-md"
              >
                <div className="flex items-center justify-between bg-white rounded-lg px-8 py-6 mb-3">
                  <p className="m-0 text-lg leading-7 font-medium text-slate-800">
                    {categoryLabel}
                  </p>
                  <div className="flex items-center gap-2">
                    <ToggleControl
                      className={'rael-widget-toggle'}
                      __nextHasNoMarginBottom
                      checked={isCategoryEnabled}
                      onChange={() => handleToggleCategory(categoryKey)}
                    />
                    <span>{__('Enable All', 'responsive-addons-for-elementor')}</span>
                  </div>
                </div>

                <div className="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-3">
                  {filteredWidgets.map((current) => (
                    <WidgetCard key={current?.slug || current?.title} data={current} />
                  ))}
                </div>
              </div>
            );
          })}
      </div>

      {showCategory !== 'all' && (
        <div className="mt-6 p-3 bg-slate-100 border border-slate-200 rounded-md">
          <div className="bg-white rounded-lg px-8 py-6 mb-3">
            <p className="m-0 text-lg leading-7 font-medium text-slate-800 capitalize">
              {showCategory}
            </p>
          </div>

          <div className="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-3">
            {widgetsList.map((current) => {

              // Skip extensions
              if (current?.category === 'extensions') return null;

              // Do not render anything when category is "all"
              if (showCategory === 'all') return null;

              // Normalize category (for "Theme Builder")
              const normalizedShowCategory =
                showCategory === 'theme builder'
                  ? 'themebuilder'
                  : showCategory?.toLowerCase();

              // Category check
              if (current?.category !== normalizedShowCategory) return null;

              // Search check
              if (search !== '' && (!current?.name?.toLowerCase().includes(search) && !current?.title?.toLowerCase().includes(search))) {
                return null;
              }

              return (
                <WidgetCard
                  key={current?.slug || current?.title}
                  data={current}
                />
              );
            })}
          </div>

        </div>
      )}

    </div>
  )
}

export default Widgets;
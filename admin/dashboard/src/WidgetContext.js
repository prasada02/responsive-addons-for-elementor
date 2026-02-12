import { createContext, useState } from "react";
import { displayToast, convertTruthyFalsyValue } from './Helper'; 

export const WidgetContext = createContext();

export const WidgetsProvider = ({ children }) => {
    const [widgetsList, setWidgetList] = useState(localize?.rael_widgets);
    const [isInitialized, setIsInitialized] = useState(false);

    const areAllWidgetsSelected = widgetsList.every((widget) => convertTruthyFalsyValue(widget?.status) === true);
    const [toggleAll, setToggleAll] = useState(areAllWidgetsSelected);

    const initialActiveWidget = widgetsList.filter((item) => convertTruthyFalsyValue(item?.status) === true);
    const initialInactiveWidget = widgetsList.filter((item) => convertTruthyFalsyValue(item?.status) === false);
    const [activeWidgetsCount, setActiveWidgetsCount] = useState(initialActiveWidget.length);
    const [inactiveWidgetsCount, setInactiveWidgetsCount] = useState(initialInactiveWidget.length);

    // const permanentlyEnabledWidgets = ['advanced-heading', 'image', 'container'];

    const handleWidgetCount = ( updatedWidgetList ) => {
        const activeWidgets   = updatedWidgetList.filter((item) => convertTruthyFalsyValue(item?.status) === true)
        const inactiveWidgets = updatedWidgetList.filter((item) => convertTruthyFalsyValue(item?.status) === false)

        setActiveWidgetsCount(activeWidgets.length);
        setInactiveWidgetsCount(inactiveWidgets.length);
    }

    const handleToggle = (checkboxKey) => {
        setWidgetList((prevCheckboxes) => {
            const updatedWidgetList = prevCheckboxes.map((checkbox) =>
                checkbox.key === checkboxKey
                    ? { ...checkbox, status: !checkbox.status }
                    : checkbox
            );

            const areAllUpdatedWidgetsChecked = updatedWidgetList.every(
                (widget) => widget.status == 1
            );

            setToggleAll(areAllUpdatedWidgetsChecked);

            handleWidgetCount( updatedWidgetList );

            if (isInitialized) {
                fetchData(updatedWidgetList);
            }

            return updatedWidgetList;
        });
    };

    const handleToggleAll = () => {
        setToggleAll(!toggleAll);

        setWidgetList((prevCheckboxes) => {
            const updatedWidgetList = prevCheckboxes.map((checkbox) => {
                // if (permanentlyEnabledWidgets.includes(checkbox.key)) {
                //     return checkbox;
                // }
                return { ...checkbox, status: !toggleAll };
            });

            handleWidgetCount( updatedWidgetList );

            fetchData(updatedWidgetList);

            return updatedWidgetList;
        });
    };

    const fetchData = async (data) => {
        const formData = new FormData();

        formData.append("action", "rbea_widgets_toggle");
        formData.append("nonce", localize.nonce);
        formData.append("value", JSON.stringify(data));

        const response = await fetch(localize.ajaxurl, {
            method: "POST",
            body: formData,
        });

        response.status === 200
            ? displayToast("Settings Saved", "success")
            : displayToast("Error", "error");
        return response.json();
    };

    useState(() => {
        setIsInitialized(true);
    }, []);

    return (
        <WidgetContext.Provider
            value={{ widgetsList, setWidgetList, handleToggle, toggleAll, handleToggleAll, activeWidgetsCount, inactiveWidgetsCount }}
        >
            {children}
        </WidgetContext.Provider>
    );
};

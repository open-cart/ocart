import withConfig from "./common/WithConfig";
import ReactDOM from "react-dom";

function Popup({children, selected, config}) {

    const close = () => {
        config.close();
        ReactDOM.unmountComponentAtNode(document.getElementById(config.id));
    }

    const insert = () => {
        if (!selected.length) {
           return;
        }
        config.insert(selected);
        close();
    }

    return (
        <div
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
            className="z-10 fixed w-full h-full top-0 left-0 flex items-center justify-center"
            // style="display:none"
        >
            <div onClick={close} className="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"/>
            <div
                className="modal-container bg-white w-11/12 mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div className="modal-content text-left px-6 pb-4">
                    <div className="modal-title flex justify-between items-center">
                        <h3 className="text-3xl pt-3">
                            Thư viện tập tin
                        </h3>
                        <div onClick={close} className="w-6">
                            <svg className="fill-current hover:text-gray-400 text-gray-600 cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        {children}
                    </div>
                    <div className="flex justify-end pt-2 h-8">
                        <button
                            type="button"
                            onClick={insert}
                            className="bg-blue-500 hover:bg-blue-400 mr-2 text-white">
                            Chèn
                        </button>
                    </div>
                </div>
            </div>
        </div>

    )
};

export default withConfig(Popup)
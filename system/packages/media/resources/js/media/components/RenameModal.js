export default function RenameModal({visible, setVisible = () => {}, children}) {
    const close = () => {
        setVisible(false)
    }

    if (!visible) {
        return [];
    }

    return (
        <div
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
            className="z-10 fixed w-full h-full top-0 left-0 flex items-center justify-center"
        >
            <div
                onClick={close}
                className="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
            <div
                className="modal-container bg-white mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div
                    onClick={close}
                    className="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                    <svg className="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                         viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span className="text-sm">(Esc)</span>
                </div>

                <div className="modal-content py-4 text-left px-6">
                    <input type="text"/>
                </div>
            </div>
        </div>

    )
};
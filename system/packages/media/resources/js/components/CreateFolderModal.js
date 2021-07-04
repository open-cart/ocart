import Button from "../common/Button";
import {useDispatch} from "react-redux";
import {createFolder} from "../actions"
import {useState} from "react";

export default function CreateFolderModal({visible, setVisible = () => {}, children}) {
    const dispatch = useDispatch();
    const [name, setName] = useState('');

    const close = () => {
        setVisible(false)
    }

    const createFolderHandler = () => {
        dispatch(createFolder(name, 0)).then(() => {
            close();
        })
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

                <div className="modal-content model-create-folder-content text-left px-6">
                    <div className="py-3">
                        <h3 className="text-2xl">Tạo mới thư mục</h3>
                    </div>
                    <hr className="-mx-6"/>
                    <div className="py-3">
                        <input className="border border-gray-300 focus:border-blue-500 focus:ring-0 bg-white text-gray-900
 appearance-none inline-block focus:text-gray-900 rounded py-2 px-3 focus:outline-none w-full"
                               placeholder="Tên thư mục"
                               value={name}
                               onChange={e => setName(e.target.value)}
                               type="text"/>
                    </div>
                    <hr className="-mx-6"/>
                    <div className="py-3">
                        <div className="flex justify-between">
                            <div></div>
                            <Button onClick={createFolderHandler}>Tạo mới</Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    )
};
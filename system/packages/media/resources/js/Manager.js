export default function Manager() {
    return (
        <div>
            <div className="sm:px-6 lg:px-8">
                <div className="bg-white">
                    <div className="col-span-12">
                        <div className="flex justify-between p-2 bg-gray-200">
                            <div>
                                <button id="upload">Upload</button>
                                <input type="file" className="hidden" id="input-upload-file"/>
                                <button id="tnmedia-create-folder">Create folder</button>
                                <button id="filemanager-refresh">Refresh</button>
                            </div>
                            <div>
                                <input placeholder="Tìm kiếm"/>
                            </div>
                        </div>
                    </div>
                    <div className="col-span-12 border-b border-red-300">
                        <div className="flex justify-between p-2 items-center">
                            <div>
                                breadcrumbs
                            </div>
                            <div>
                                <button>Order</button>
                            </div>
                        </div>
                    </div>
                    <div className="grid grid-cols-12 gap-4 px-2">
                        <div className="col-span-9 py-2">
                            <div className="grid grid-cols-12 gap-3 sm:gap-6">
                                {
                                    [1,2,3,4,5,6,1,1,1,1,11,1,1,1,1,1,1,1,21].map(() => (
                                        <div
                                            className="media-item rounded bg-white col-span-6 sm:col-span-4 md:col-span-3 xl:col-span-2">
                                            <div className="rounded-md relative">
                                                <div
                                                    className="hidden hover:block bounce media-item-selected absolute right-0 top-0 mt-2 mr-2 h-6 w-6 bg-blue-500 z-10 rounded-full">
                                                    <svg className="fill-current text-white" xmlns="http://www.w3.org/2000/svg"
                                                         viewBox="0 0 512 512">
                                                        <path
                                                            d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path>
                                                    </svg>
                                                </div>
                                                <a href="#"
                                                   className="tnmedia-folder block tn-media-thumbnail relative w-full">
                                                    <img src="./folder.svg" alt=""/>
                                                </a>
                                                <div className="tn-media-description">
                                                    <div
                                                        className="block font-medium py-1 text-center truncate">Name</div>
                                                </div>
                                            </div>
                                        </div>
                                    ))
                                }

                            </div>
                        </div>
                        <div className="pt-2 col-span-3 gap-4 space-y-4 border-l border-red-300">
                            <div className="px-3">
                                <div className="rounded bg-white">
                                    preview image
                                </div>

                            </div>
                            <div className="bg-white p-3">
                                info image
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
};
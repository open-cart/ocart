import {useState, useEffect} from "react";
import ReactDOM from "react-dom";
import PreviewImage from "./components/PreviewImage";
import Button from "./common/Button";
import Icon from "./common/Icon";
import {classNames} from "./common/utils";
import Dropdown from "./common/Dropdown";
import ContextMenu from "./common/ContextMenu";
import ButtonUpload from "./components/ButtonUpload";
import EventEmitter from "./common/EventEmitter";
import CreateFolderModal from "./components/CreateFolderModal";
import RenameModal from "./components/RenameModal";
import {UploadController} from "./controllers/UploadController";
import withConfig from "./common/WithConfig";

function Content({onChange = () => {}, onLastSelected = () => {}, popup = false, config}) {
    const [listFiles, setListFiles] = useState([]);
    const [typeView, setTypeView] = useState('gird');
    const [selected, setSelected] = useState([]);
    const [lastSelected, setLastSelected] = useState([]);
    const [visible, setVisible] = useState(false);
    const [loading, setLoading] = useState(false);
    const [fileMenu, setFileMenu] = useState({});
    const [folderMenu, setFolderMenu] = useState({});
    const [visibleCreate, setVisibleCreate] = useState(false);
    const [visibleRename, setVisibleRename] = useState(false);

    const selectCtrlItem = file => {
        if (!selected.includes(file)) {
            setSelected([...selected, file]);
        } else {
            setSelected(selected.filter(item => item !== file));
        }
    }
    const selectShiftItem = file => {
        const start = listFiles.indexOf(lastSelected);
        const end = listFiles.indexOf(file);
        const items = listFiles.slice(start, end + 1);

        for (let value of items) {
            if (!selected.includes(value)) {
                selected.push(value);
            }
        }
        setSelected([...selected]);
    }


    const changeImage = (file, e) => {
        if (!config.multiple) {
            setSelected([file]);
        } else {
            if (e) {
                if (e.ctrlKey || e.metaKey) {
                    selectCtrlItem(file);
                } else if (e.shiftKey) {
                    selectShiftItem(file);
                } else {
                    setSelected([file]);
                }
            }
        }
        setLastSelected(file);
    }

    const changeFolder = () => {
        setVisible(true);
    }

    const contextMenuHandle = (file, e) => {
        setSelected([file]);
        setLastSelected(file);

        if (file.type === 'folder') {
            return folderMenu.contextMenuHandle(file, e);
        }
        return fileMenu.contextMenuHandle(file, e);
    }

    const fetchList = () => {
        EventEmitter.emit('before');
        UploadController.list().then(res => {
            console.log(res)
            setListFiles(res.items);
        }).finally(() => {
            EventEmitter.emit('after');
        })
    }

    useEffect(() => {
        onChange(selected);
    }, [selected]);

    useEffect(() => {
        onLastSelected(lastSelected);
    }, [lastSelected])

    useEffect(() => {
        EventEmitter.subscribe('before', () => {
            setLoading(true);
        });
        EventEmitter.subscribe('after', () => {
            setLoading(false);
        });
        EventEmitter.subscribe('refresh', event => {
            console.log("button pressed inside child");
            console.log(event);
            fetchList()
        });

        EventEmitter.subscribe('rename-modal', event => {
            setVisibleRename(true);
            fetchList();
        });
    }, [])

    useEffect(() => {
        fetchList()
    }, [])


    return (
        <div className="media-container">

            {
                loading ? (
                    <div className="media-background-loading flex items-center justify-center">
                        <div className="flex items-center justify-center h-12 w-12 bg-white rounded-full">
                            <svg className="animate-spin h-10 w-10 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path className="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                ): ([])
            }
            <div id="context-menu-backdrop"/>
            <PreviewImage visible={visible} setVisible={setVisible}>
                <img src={lastSelected.full_url} alt=""/>
            </PreviewImage>
            <CreateFolderModal visible={visibleCreate} setVisible={setVisibleCreate}/>
            <RenameModal visible={visibleRename} setVisible={setVisibleRename}/>
            <ContextMenu menu={setFileMenu}>
                <li>1</li>
                <li>2</li>
                <li>3</li>
                <li>4</li>
            </ContextMenu>
            <ContextMenu menu={setFolderMenu}>
                <li>1</li>
                <li>2</li>
                <li>3</li>
            </ContextMenu>
            <div className="media-header">
                <div className="media-header-top flex justify-between">
                    <div>
                        <ButtonUpload/>
                        <Button
                            onClick={() => setVisibleCreate(true)}
                            icon={<Icon name="folder"/>}>
                            Tạo thư mục
                        </Button>
                        <Button onClick={() => EventEmitter.emit('refresh')}icon={<Icon name="refresh"/>}>
                            Làm mới
                        </Button>
                        <Dropdown items={['name']}>
                            <Button icon={<Icon name="filter"/>}>
                                Lọc
                            </Button>
                        </Dropdown>
                    </div>
                    <div>
                        <input type="text"
                               className="py-1.5 border px-4 bg-white placeholder-gray-400 text-gray-900 rounded appearance-none w-full block focus:outline-none"/>
                    </div>
                </div>
                <div className="media-header-bottom flex justify-between">
                    <div>Tất cả tập tin</div>
                    <div>
                        <Dropdown items={['desc']}>
                            <Button iconRight={<Icon name="sort-up"/>}>
                                Sắp xếp
                            </Button>
                        </Dropdown>
                        <Dropdown items={['delete']}>
                            <Button iconRight={<Icon name="dots"/>}>
                                Thao tác
                            </Button>
                        </Dropdown>
                        <Button
                            onClick={() => setTypeView('gird')}
                            className={{
                                "btn-left": true,
                                'active': typeView === 'gird',
                            }}
                            iconRight={<Icon name="gird"/>}>
                        </Button>
                        <Button
                            onClick={() => setTypeView('list')}
                            className={{
                                "btn-right": true,
                                'active': typeView === 'list',
                            }}
                            iconRight={<Icon name="list"/>}>
                        </Button>
                    </div>
                </div>
            </div>
            <div className="media-content">
                <div className="media-main-wrapper">
                    <div className="media-main">
                        <div className="media-items p-4">
                            <ul className={classNames({
                                'media-gird': typeView === 'gird',
                                'media-list': typeView === 'list',
                            })}>
                                {listFiles.map((item, index) => {
                                    return (
                                        <li key={index}
                                            className="media-list-title"
                                            onClick={(e) => changeImage(item, e)}
                                            onDoubleClick={(e) => changeFolder(item)}
                                            onContextMenu={e => contextMenuHandle(item, e)}
                                        >
                                            <div className={{active: selected.includes(item)}}>
                                                <div className="file-item">
                                                    <div className="thumbnail">
                                                        <img src={item.full_url} alt=""/>
                                                    </div>
                                                    <div className="font-weight-regular text-center text-truncate">
                                                        {item.name}
                                                    </div>
                                                    <span className="media-item-selected"
                                                          style={{display: !selected.includes(item) ? 'none' : 'block'}}
                                                    ><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 512 512"><path
                                                        data-v-97d3c306=""
                                                        d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"></path></svg></span>
                                                </div>
                                            </div>
                                        </li>
                                    )
                                })}
                            </ul>
                        </div>
                        <div className="media-details">
                            <div>
                                <div>
                                    <div className="thumbnail">
                                        <img src={lastSelected.full_url} alt="..."/>
                                    </div>
                                    <div className="description">
                                        mo ta
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
};

export default withConfig(Content)
import {useState, useEffect, useRef} from "react";
import {classNames} from "./utils";
import ReactDOM from "react-dom";

export default function ContextMenu({children, menu = () => {}}) {
    const contextMenu = useRef(null);
    const [viewMenu, setViewMenu] = useState(null);
    const [menuStyle, setMenuStyle] = useState({top: '-500px', left: '0px'});

    const contextMenuHandle = (file, e) => {
        e.preventDefault();

        setViewMenu(true);

        let top = e.clientY;
        let left = e.clientX;

        const dom = ReactDOM.findDOMNode(contextMenu.current);

        let largestHeight = window.innerHeight - dom.offsetHeight - 25;
        let largestWidth = window.innerWidth - dom.offsetWidth - 25;

        if (top > largestHeight) top = largestHeight;

        if (left > largestWidth) left = largestWidth;

        top = top + 'px';
        left = left + 5 + 'px';
        setMenuStyle({
            left,
            top
        });
    }

    const closeMenu = () => {
        setViewMenu(false)
        setMenuStyle({top: '-500px', left: '0px'})
    }

    useEffect(() => {
        menu({contextMenuHandle});
    }, [])

    return (
        <div className="container-context-menu">
            {
                viewMenu ? (
                    <div
                        onMouseDown={closeMenu}
                        id="context-menu-layer"/>
                ): []
            }
            <div
                className="context-menu"
                id="right-click-menu"
                style={{
                    opacity: viewMenu ? '1' : '0',
                    ...menuStyle
                }}
            >
                <ul
                    ref={contextMenu}
                    onClick={closeMenu}
                >
                    {children}
                </ul>
            </div>
        </div>
    )
}


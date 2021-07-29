import {useState} from "react";
import {classNames} from "./utils";

function DropdownItem({children, ...props}) {
    return (
        <li {...props}>{children}</li>
    )
}

export default function Dropdown({children, items}) {
    const [active, setActive] = useState(false);

    const closeDropdown = () => {
        setActive(false);
    }
    return (
        <div className="dropdown">
            {
                active ? (
                    <div
                        onMouseDown={closeDropdown}
                        id="context-menu-layer"/>
                ): []
            }
            <span onClick={() => setActive(true)}>
                {children}
            </span>
            <div className={classNames({
                'dropdown-content': true,
                'active': active
            })}>
                <ul onClick={closeDropdown}>
                    {items.map((item) => {
                        return <DropdownItem>{item}</DropdownItem>
                    })}
                </ul>
            </div>
        </div>
    )
}


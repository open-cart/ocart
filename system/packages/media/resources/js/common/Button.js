import {classNames} from "./utils";

export default function Button({children, icon, iconRight, className, ...props}) {
    className = typeof className === 'string' ? {[className]: true} : className
    return (
        <button {...props} type="button" className={classNames({"ripple": true, ...className})}>
            <span>
                {icon ? (<span>{icon}&nbsp;</span>) : ''}
                {children}
                {iconRight ? (<span>&nbsp;{iconRight}</span>) : ''}
            </span>
        </button>
    )
}
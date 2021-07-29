import React from 'react';
// Theme context, default to light theme
export const ConfigContext = React.createContext({

});

export default function withConfig(Component) {
    return function (props) {
        return <ConfigContext.Consumer>
            {
                config => (
                    <Component config={config} {...props}/>
                )
            }
        </ConfigContext.Consumer>
    }
}
import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';
import './index.css';
import './media.css';
import {ConfigContext} from "./common/WithConfig";
import {HttpClient} from "./controllers/HttpClient";
import { Provider } from 'react-redux'
import store from './store'

// import reportWebVitals from './reportWebVitals';


function TnMedia(options) {
    const defaultOptions = {
        id: 'tn-manager',
        popup: true,
        multiple: true,
        insert: () => {
        },
        close: () => {},
    }

    const config = {...defaultOptions, ...options};

    HttpClient.config = config;

    // ReactDOM.unmountComponentAtNode(document.getElementById(config.id));

    ReactDOM.render(
        <ConfigContext.Provider value={config}>
            <Provider store={store}>
                <App title={options.title} id={config.id} popup={config.popup}/>
            </Provider>
        </ConfigContext.Provider>,
        document.getElementById(config.id)
    );


}

export default TnMedia;

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
// reportWebVitals();

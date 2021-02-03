import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom'

export default class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    Hello
                </div>
            </BrowserRouter>
        );
    }
}

// ReactDOM.render(<App />, document.getElementById('app'));

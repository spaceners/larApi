import React, { Component } from "react";
import ReactDOM from "react-dom";

export default class Example extends Component {
    render() {
        return <div className="card-header">Example Component</div>;
    }
}

if (document.getElementById("example")) {
    ReactDOM.render(<Example />, document.getElementById("example"));
}

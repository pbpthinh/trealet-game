import React from "react";
import ReactDOM from "react-dom";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import { Provider } from "react-redux";
import store from "./redux/store";
import MapsScreen from "./screen/Maps/MapsScreen";
import "./App.css";
import "rsuite/dist/rsuite.min.css";


const App = () => (
  <Provider store={store}>
    <Router>
      <Switch>
        <Route path="/maps" component={MapsScreen} />
      </Switch>
    </Router>
  </Provider>
);
ReactDOM.render(<App />, document.getElementById("maps"));

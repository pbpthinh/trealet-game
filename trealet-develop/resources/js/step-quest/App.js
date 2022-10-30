import 'bootstrap/dist/css/bootstrap.min.css';
import {
  BrowserRouter as Router, Route, Switch
} from "react-router-dom";
import './App.css';
import GameIntro from './components/Screen/AboutGame/GameIntro';

function App() {
  document.getElementsByClassName("content-page")
  return (
    <div className="App">
      <Router>
        <Switch>
          {/* route đến màn danh sách bảo tàng */}
          <Route path="/stepquest/:id" component = {GameIntro} />
          
          {/* <Route path="/stepquest/game/:id" component = {GameIntro} /> */}
          {/* <Route path="/stepquest" component = {ListMuseum} /> */}
        </Switch>
      </Router>
    </div>
  );
}
export default App;


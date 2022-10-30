import React, { Component } from "react";
import "./ScreenDisplay.css";

class ScreenDisplay extends Component {
  constructor(props) {
    super(props);
    this.state = {};
    console.log(this.props);
  }
  render() {
    return (
      <div className="ScrDisplay">
        <div className="img_Game">
          {this.props.data.file ? undefined: (<iframe className="display-youtube my-box-shadow" width={350} height={200} src={this.props.data.youtube} frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>) }
          {this.props.data.youtube ? undefined: (<img className = "display-img my-box-shadow" src= {this.props.data.file } />)}

        </div>
        <div className="name">
          <h4>{this.props.data.title}</h4>
        </div>
        <div className="des">
          <p>{this.props.data.description}</p>
        </div>
      </div>
    );
  }
}
export default ScreenDisplay;

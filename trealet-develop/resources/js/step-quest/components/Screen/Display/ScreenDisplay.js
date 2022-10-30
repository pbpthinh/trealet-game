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
      <div className="step--display">
        <div className="step--display__media">
          {this.props.data.youtube && 
            (<iframe className="media--youtube my-box-shadow" width={350} height={200} src={this.props.data.youtube} frameBorder="0" allowFullScreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>) }
          {this.props.data.file && 
            (<img className = "media--img my-box-shadow" src= {this.props.data.file } />)}
        </div>
        <div className="step--display__title game-card game-title">
          {this.props.data.title}
        </div>
        <div className="step--display__des game-card">
          {this.props.data.description}
        </div>
      </div>
    );
  }
}
export default ScreenDisplay;

import React, { Component } from "react";
import "./Picture.css";
class ScreenPicture extends Component {
  constructor(props) {
    super(props);
    var tr_id = new URL(window.location.href).searchParams.get("tr");
    this.state = {
      tr_id,
    };
  }
  render() {
    var src = `${window.location.origin}/input-picture?tr_id=${this.state.tr_id}&nij=3`;
    return (
      <div className="step--picture">
        <div className="step--picture__title game-card game-title">{this.props.data.hint}</div>
        <div className="step--picture__content">
          <iframe
            style={{ position: "relative", height: "340px", width: "90%", margin: "auto" }}
            src={src}
            title="Chụp ảnh"
            frameBorder="0"
            allow="microphone"
          />
        </div>
      </div>
    );
  }
}

export default ScreenPicture;

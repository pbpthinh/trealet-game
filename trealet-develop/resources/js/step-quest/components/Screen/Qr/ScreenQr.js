import React, { Component } from "react";
import "./ScreenQr.css";
class ScreenQr extends Component {
  constructor(props) {
    super(props);
    var tr_id = new URL(window.location.href).searchParams.get("tr");
    this.state = {
      tr_id,
    };
  }

  render() {
    var src = `${window.location.origin}/input-qr?tr_id=${this.state.tr_id}&nij=5`;
    return (
      <div class="step--qr">
        <div className="step--qr__title game-card game-title">
          {this.props.data.hint}
        </div>
        <div className="step--qr__content">
          <iframe
            style={{ position: "relative", height: "340px", width: "90%", margin: "auto" }}
            src={src}
            title="Quét mã QR"
            frameBorder="0"
            allow="microphone"
            className="iframe"
          />
        </div>
      </div>
    );
  }
}
export default ScreenQr;

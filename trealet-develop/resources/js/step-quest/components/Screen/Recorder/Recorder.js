// import AudioReactRecorder, { RecordState } from "audio-react-recorder";
import "audio-react-recorder/dist/index.css";
import React from "react";
import "./Recorder.css";
// import { Button } from "react-bootstrap";

class Recorder extends React.Component {
  constructor(props) {
    super(props);
    var tr_id = new URL(window.location.href).searchParams.get("tr");
    this.state = {
      tr_id,
    };
  }
  render() {
    var src = `${window.location.origin}/input-audio?tr_id=${this.state.tr_id}&nij=1`;
    return (
      <div className="step--recorder">
        <div className="step--recorder__title game-card game-title">{this.props.data.hint}</div>
        <div className="step--recorder__content">
          <iframe
            style={{ position: "relative", height: "340px", width: "90%", margin: "auto", backgroundColor: "#fff" }}
            src={src}
            title="Ghi âm"
            frameBorder="0"
            allow="microphone"
          />
        </div>
      </div>
    );
  }
}

export default Recorder;

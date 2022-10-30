import React, { Component } from "react";
import { withRouter } from "react-router-dom";
import Button from "../common/button/index.js";
import ScreenDisplay from "../Screen/Display/ScreenDisplay";
import ScreenPicture from "../Screen/Picture/Picture";
import ScreenQr from "../Screen/Qr/ScreenQr";
import Answer from "../Screen/Question/Answer";
import Recorder from "../Screen/Recorder/Recorder";
import ScreenResult from "../Screen/Result/ScreenResult";
import "./ContentGame.css";

class ContentGame extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isShowResult: false,
    };
    this.onClickNext = this.props.clickNext;
    this.onClickPrev = this.props.clickPrevious;
    this.checkAnswer = this.props.checkAnswer
    this.handleScore = this.props.handleScore
  }
  
  showResult() {
    this.onClickNext();
    this.setState({ isShowResult: true });
  }
  
  render() {
    const me = this
    const currentStepData = me.props.steps?.find((prod, idx) => idx == me.props.currentIndex);
    let hienthi;
    
    if (currentStepData?.type == "Quizz") {
      hienthi = (
        <Answer
          data={currentStepData}
          handleScore={this.handleScore}
          checkAnswer={this.checkAnswer}
        />
      );
    } else if (currentStepData?.type == "Display") {
      hienthi = <ScreenDisplay data={currentStepData} />;
    } else if (currentStepData?.type == "QR") {
      hienthi = <ScreenQr data={currentStepData} />;
    } else if (currentStepData?.type == "Audio") {
      hienthi = <Recorder data={currentStepData} />;
    } else if (currentStepData?.type == "Picture") {
      hienthi = <ScreenPicture data={currentStepData} />;
    }
    
    return (
      <div className="content-game-container">
        {me.state.isShowResult ? (
          <ScreenResult data={me.props.score} minScore={me.props.minScore} gift={me.props.gift} />
        ) : (
          <div className="h-full d-flex flex-column">
            <div className="flex-1"> {hienthi} </div>
            <div className="content-game__footer">
              {this.props.currentIndex != 0 && (
                <Button className="flex-1 secondary" onClick={this.onClickPrev}> Quay lại </Button>
              )}
              {this.props.currentIndex < this.props.steps?.length - 1 && (
                <Button className="flex-1" onClick={this.onClickNext}> Tiếp tục </Button>
              )}
              {this.props.currentIndex == this.props.steps?.length - 1 && (
                <Button className="flex-1" onClick={this.showResult.bind(this)}> Tiếp tục </Button>
              )}
            </div>
          </div>
        )}
      </div>
    );
  }
}
export default withRouter(ContentGame);

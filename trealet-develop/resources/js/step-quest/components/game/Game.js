import { Progress } from "antd";
import "antd/dist/antd.css";
import React, { Component } from "react";
import { Dropdown } from "react-bootstrap";
import { FaBars, FaStar } from "react-icons/fa";
import ContentGame from "../Home/ContentGame";
import "./Game.css";

class Game extends Component {
  constructor(props) {
    super(props);
    let self = this
    this.state = {
      score: 0,
      currentIndex: 0,
      sumStep: props.data.items?.length || 0,
      width: 100,
      backgroundColor: "green",
      interval: null,
      bonusScore: 0,
      showBonusScore: false,
      isShowRemainingTime: true,
      bonusScorePositionBottom: "50%",
      musicStatus: props.musicStatus
    };

    // remaining time
    this.timeLeft = 10;
    this.allTime = 10;
    this.interval = undefined;
    setInterval(function() {
      if (localStorage.getItem("current")) {
        clearInterval(self.interval)
      }
    }, 1000)
  }

  componentDidMount() {
    this.startTime(this.props.data.items[this.state.currentIndex]);
  }

  changeMusicStatus = () => {
    const me = this
    const audioEle = document.getElementById("backgroundMusic")
    const currentState = me.state.musicStatus

    if (currentState) {
      audioEle?.pause()
    } else {
      audioEle?.play()
    }
    me.setState({musicStatus: !currentState})
  }

  startTime(step) {
    var me = this;

    me.setState({
      width: 100,
      backgroundColor: "green",
    });
    me.timeLeft = step.time;
    me.allTime = step.time;
    step.isTimeUp = false
    clearInterval(me.interval);
    if (!step.isUnlimitedTime && !step.isChecked) {
      me.setState({
        isShowRemainingTime: true
      })
      me.interval = setInterval(() => {
        me.timeLeft = me.timeLeft - 0.1;
        var width = (me.timeLeft * 100) / me.allTime;
        if (me.timeLeft < 0) {
          step.isTimeUp = true
        }
        me.setState({
          width: width,
          backgroundColor: width > 50 
            ? "green" 
            : width > 25
              ? "orange"
              : "red",
        });
      }, 100);
    } else {
      me.setState({
        isShowRemainingTime: false
      })
    }
  }

  handleScore = (increaseScore) => {
    increaseScore = Number(increaseScore) || 0
    var currentScore = this.state.score;
    this.setState({ score: currentScore + increaseScore, showBonusScore: true, bonusScore: increaseScore, bonusScorePositionBottom: "50%" });

    
    setTimeout(() => {
      this.setState({ bonusScorePositionBottom: "80%" });
      setTimeout(() => {
        this.setState({ showBonusScore: false});
      }, 500)
    }, 100);
  };

  checkStepEnable = (step) => {
    return step && (step.isUnlimitedTime || (!step.isTimeUp && !step.isChecked)) 
  }

  handleChangeStep = (nextIndexStep) => {
    if (nextIndexStep < 0 || nextIndexStep >= this.state.sumStep) {
      return;
    }

    const nextStep = this.props.data.items[nextIndexStep]
    let currentStep = this.props.data.items[this.state.currentIndex]
    let increaseScore = null
    
    if (this.checkStepEnable(currentStep)) {
      let answer = localStorage.getItem("current")
      
      if (currentStep.type == "QR") {
        if(answer == currentStep.code) {
          increaseScore = Number(currentStep.score);  
        }
      } else if (currentStep.type == "Audio" || currentStep.type == "Picture") {
        if(answer == 1) {
          increaseScore = Number(currentStep.score);
        }
      } else if (currentStep.type == "Display") {
        increaseScore = Number(currentStep.score);
      }
    }
    if (!(currentStep.isUnlimitedTime && currentStep.type === "Quizz")) {
      currentStep.isChecked = true
    }
    localStorage.removeItem("current")
    this.startTime(nextStep);
    this.setState({
      currentIndex: nextIndexStep,
    });
    if (increaseScore) {
      this.handleScore(increaseScore)
    }
  }
  
  handleStepNext = () => {
    this.handleChangeStep(this.state.currentIndex + 1)
  };
  
  handleStepPrevious = () => {
    this.handleChangeStep(this.state.currentIndex - 1)
  };

  checkAnswer = () => {
    this.props.data.items[this.state.currentIndex].isChecked = true;
    clearInterval(this.interval);
  };

  render() {
    const me = this
    const progressStep = ((this.state.currentIndex) * 100) / this.state.sumStep;
    
    return (
      <div className="h-100 Game">
        <div className="headerGame">
          <audio id="backgroundMusic" autoPlay={this.props.musicStatus}>
            <source src="../../assets/audio/wemida-waiting-for-the-end-quizzing-voting-background-music-16575.mp3" type="audio/mp3" />
          </audio>
          <Dropdown>
            <Dropdown.Toggle variant="success" id="dropdown-basic">
              <FaBars />
            </Dropdown.Toggle>{" "}
            <Dropdown.Menu>
              <Dropdown.Item onClick={me.changeMusicStatus}> Nhạc: {me.state.musicStatus ? " bật" : " tắt"} </Dropdown.Item>
              <Dropdown.Item href="/"> Thoát Game </Dropdown.Item>
            </Dropdown.Menu>{" "}
          </Dropdown>{" "}
          <Progress percent={progressStep} />{" "}
          <div className="score"> {this.state.score} </div>{" "}
          <FaStar className="star" />
        </div>{" "}
        <div className="time">
          {this.state.isShowRemainingTime ? (
            <div
              className="timeleft"
              style={{
                width: this.state.width + "%",
                background: this.state.backgroundColor,
              }}
            ></div>
          ) : ''}
        </div>
        <div className="content">
          <ContentGame
            steps={this.props.data.items}
            score={this.state.score}
            minScore={this.props.data.minScore} 
            gift={this.props.data.gift}
            currentIndex={this.state.currentIndex}
            handleScore={this.handleScore}
            checkAnswer={this.checkAnswer}
            clickPrevious={this.handleStepPrevious}
            clickNext={this.handleStepNext}
          />
        </div>
        {
          this.state.showBonusScore ? 
          <div className="animation-score" id="bonus-score" style={{bottom: this.state.bonusScorePositionBottom}}>
            <div className="score"> {"+" + this.state.bonusScore} </div>{" "}
            <FaStar className="star" />
          </div>
          : ""
        }
        
      </div>
    );
  }
}
export default Game;

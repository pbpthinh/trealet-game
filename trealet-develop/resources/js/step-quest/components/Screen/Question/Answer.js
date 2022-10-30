import React, { Component } from "react";
import { ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import "./Answer.css";
class Answer extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isLoading: false
    };
  }
  
  checkAnswer(answer) {
    if (
      answer &&
      !this.props.data.isChecked &&
      !this.props.data.isTimeUp
    ) {
      this.setState({ isLoading: true });
      this.props.data.isChecked = true;
      this.props.checkAnswer();
      if (this.props.data.answer == answer.id) {
        answer.isCorrect = true;
        this.props.handleScore(parseInt(this.props.data.score));

        // setTimeout(() => {
        //   toast.success("Chính xác! Chúc mừng bạn", {
        //     position: "top-center",
        //     autoClose: 3000,
        //     theme: "colored",
        //     hideProgressBar: false,
        //     closeOnClick: true,
        //     pauseOnHover: true,
        //     draggable: true,
        //     progress: undefined,
        //   });
        // }, 300);
      } else {
        answer.isWrong = true;
        // setTimeout(() => {
        //   toast.error("Sai rồi! Hãy cố lên nhé", {
        //     position: "top-center",
        //     autoClose: 3000,
        //     theme: "colored",
        //     hideProgressBar: false,
        //     closeOnClick: true,
        //     pauseOnHover: true,
        //     draggable: true,
        //     progress: undefined,
        //   });
        // }, 300);
      }
      this.setState({ isLoading: false });
    }
  }
  
  render() {
    const listItems = this.props.data.ListOption.map((answer, index) => (
      <div
        key={answer.id}
        className={`answer-text answer-text-${index} ${answer.isCorrect ? "correct" : ""} ${
          answer.isWrong ? "wrong" : ""
        } ${this.props.data.isTimeUp || this.props.data.isChecked ? "disabled" : ''}`}
        onClick={() => this.checkAnswer(answer)}
      >
        {answer.text}
      </div>
    ));
    return (
      <div className="step--quiz">
        {this.props.data.file && (
          <div className="step--quiz__img flex-c-m">
            <img className="img-q" src={this.props.data.file} />
          </div>
        )}
        <div className="step--quiz__question game-card game-title"> {this.props.data.question} </div>
        <div className="step--quiz__options"> {listItems} </div>
        {
          this.props.data.isChecked
          ? (this.props.data.ListOption?.some(item => item.isCorrect)
              ? <div className="step--quiz__result game-card">
                <div className="text-success">
                  <b>Chính xác! Chúc mừng bạn.</b>
                </div>
                <div className="text-left">
                {`Giải thích: ${this.props.data.hint || '---'}`}
                </div>
              </div>
              : (this.props.data.ListOption?.some(item => item.isWrong) && 
                <div className="step--quiz__result game-card">
                  <div className="text-wrong">
                    <b>Sai rồi! Hãy cố lên nhé</b>
                  </div>
                  <div className="text-left">
                    {`Giải thích: ${this.props.data.hint || '---'}`}
                  </div>
                </div>)
            )
          : (
              this.props.data.isTimeUp && 
              <div className="step--quiz__result game-card">
                <div className="">
                  Đã hết thời gian trả lời!
                </div>
              </div>
            )
        }
        <ToastContainer />
      </div>
    );
  }
}
export default Answer;

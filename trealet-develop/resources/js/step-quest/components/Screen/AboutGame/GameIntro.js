// import { Button } from "react-bootstrap";
import axios from "axios";
import React, { Component } from "react";
import Button from "../../common/button/index.js";
import Loader from "../../common/loader/index";
import Game from "../../game/Game";
import "./GameIntro.css";

class GameIntro extends Component {
  constructor(props) {
    super(props);
    this.state = {
      game: undefined,
      showGameDetail: false,
      musicStatus: true,
      loading: true
    };
  }

  loadGameData = () => {
    if (this.props.match && this.props.match.params) {
      let id = this.props.match.params.id;
      axios
        .get(`${window.origin}/api/trealets/stepquest/${id}`)
        .then((response) => {
          var data = response.data?.data?.json?.trealet;
          this.setState({ game: data, loading: false });
        });
    }
  }
  startGame = () => {
    this.setState({
      showGameDetail: true,
    });
  };
  quit = () => {
    location.replace(`/`);
  }
  changeMusicStatus = () => {
    this.setState({
      musicStatus: !this.state.musicStatus,
    });
  }

  componentDidMount() {
    this.loadGameData();
  }
  
  render() {
    return (
      <div className="flex-1 game-container">
        {
          this.state.loading 
          ? (
            <Loader />
          )
          : this.state.showGameDetail 
            ? <Game data={this.state.game} musicStatus={this.state.musicStatus} />
            : <div className="game-intro w-full">
                <div className="game-intro__options">
                  <div className="option__row option__sound">
                    <Button onClick={this.changeMusicStatus} className="button-icon">
                      <img width={24} height={24} src={`${window.origin}/assets/images/volume-${this.state.musicStatus ? 'on' : 'off'}.svg`}></img>
                    </Button>
                  </div>
                </div>
                <div className="game-intro__info">
                  <div className="info__title game-card">
                    {this.state.game?.title || ""}
                  </div>
                  <div className="info__description game-card">
                    {this.state.game?.des || ""}
                  </div>
                </div>
                <div className="game-intro__footer">
                  <Button onClick={this.startGame}> Bắt đầu </Button>
                  <Button onClick={this.quit} className="secondary"> Thoát </Button>
                </div>
              </div>
        }
      </div>
    );
  }
}
export default GameIntro;

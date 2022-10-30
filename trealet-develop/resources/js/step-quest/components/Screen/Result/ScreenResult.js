import React, { Component } from 'react';
import Button from '../../common/button/index';
import './ScreenResult.css';

class ScreenResult extends Component{
    constructor(props){
        super(props);
    }

    replay() {
        location.reload();
    }
    goToHome = () => {
        location.replace(`/`);
    }


    render(){
        const me = this

        return (
            <div className="game-result">
                <div className='game-result__info game-card'>
                    <div className = "result-title">
                        <h5>Chúc mừng bạn đã hoàn thành trò chơi</h5>
                        <h5>Số điểm của bạn là: {this.props.data.score || 0}</h5>
                    </div>
                    {
                        this.props.data.score >= (this.props.minScore || 0) && 
                        (
                            <div className = "result-content"> <p>
                                {`Phần thưởng của bạn là ${this.props.gift || "--"}. Hãy chụp lại màn hình và
                                đến phòng lưu niệm để nhận phần quà này`}
                            </p></div>
                        )
                    }
                </div>
                <div className = "result-img">
                    <img className = "result_img_img" src= 'https://i.pinimg.com/originals/ab/c8/05/abc805563d75437aa698b7c0df476302.gif' alt={"img"} />
                </div>
                <div className = "result-button">
                    <Button onClick={() => this.replay()} className="secondary flex-1">
                        Chơi lại
                    </Button>
                    <Button onClick={me.goToHome} className="flex-1">Trang chủ</Button>
                </div>
            </div>
            
        )
    }
}
export default ScreenResult;
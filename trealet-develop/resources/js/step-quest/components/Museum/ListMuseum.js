import React, { Component } from "react";
import axios from "axios";
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import BtnStart from "./ListGame";
import { FaAngleRight } from "react-icons/fa";
import { FaAngleLeft } from 'react-icons/fa';
import './ListMuseum.css'
class ListMuseum extends Component {
    constructor(props) {
        super(props);
        this.state = {
            listGames: [],
            game: false,
            title: "Danh sách trò chơi"
        }
    }

    componentDidMount() {
        // gọi service lấy danh sách bảo tàng
        axios.get('http://localhost:3002/games')
            .then(response => {
                this.setState({ listGames: response.data });
            })
    }

    /**
     * quay lại danh sách bảo tàng
     */
    backListMuseum() {
        this.setState({
            title: "Danh sách trò chơi",
            game: undefined
        });
    }

    showIntro(item) {
        this.setState({
            game: item,
            title: item.name
        });
    }

    render() {
        const listItems = this.state.listGames.map((item) =>
            <BtnStart key={item.id} data={item} />
        );

        return (
            <div className="listMuseum">
                <div className="d-flex w-80 mt-2 pb-3 text-title">
                    <div className="title flex-c-m">{this.state.title}
                    </div>
                </div>

                <div className="list"><div >{listItems}</div>
                    <ToastContainer />
                </div>
            </div>


        )


    }

}
export default ListMuseum;
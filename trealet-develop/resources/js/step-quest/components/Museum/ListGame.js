
import React from 'react';
import { useHistory } from 'react-router-dom';
import './ListGame.css'
import { Button } from "react-bootstrap";
import { FaAngleRight } from 'react-icons/fa';
const BtnStart = (props) => {
    const history = useHistory();
    const handleClick = () => history.replace(`/stepquest/game/${props.data.id}`);

    return (
        <div className="w-100 flex-c-m listGame">
            <div className = "List" onClick={handleClick}>{props.data.title} <FaAngleRight className="FaAngleRight"/></div>
        </div>
    );
};

export default BtnStart;
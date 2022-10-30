import React, { useState } from "react";
import CameraIcon from "./CameraIcon";
import AudioIcon from "./AudioIcon";
import QrIcon from "./QrIcon";
import FormIcon from "./FormIcon";

const greatPlaceStyle = {
    position: "absolute",
    transform: "translate(-10%, -10%)",
};

const Marker = (props) => {
    // const [size, setstate] = useState(65)
    const onClick = () => {
        props.onClickMarker(true, props.detail);
    };
    const size = 80;
    // console.log(props.detail);
    const color = props.detail.played ? "#157B15" : "#d43a02";
    return (
        <div
            style={{
                opacity: props.detail.played ? 0.9 : 1,
                height: size,
                width: size,
                position: "absolute",
                marginTop: size * -0.4,
                marginLeft: size * -0.4,
                transform: "translate(-10%, -10%)",
                display: props.zoom < 13 ? "none" : "",
            }}
        >
            {props.detail?.index === 0 ? (
                <div
                    style={{
                        height: size * 0.3,
                        width: size * 0.5,
                        margin: "auto",
                        marginTop: size * - 0.4,
                    }}
                >
                    <div
                        style={{
                            height: size * 0.25,
                            borderColor: "green",
                            borderWidth: 1,
                            borderRadius: size * 0.05,
                            marginTop: size * 0.1,
                            backgroundColor: "#32a852",
                            textAlign: "center",
                            color: "#FFF",
                            fontWeight: "bold",
                            marginLeft: size * -0.03,
                        }}
                    >
                        <p style={{padding: size * 0.05 }}>
                            Start
                        </p>
                    </div>
                </div>
            ) : null}
            <div
                onClick={onClick}
                style={{
                    margin: "auto",
                    height: size * 0.4,
                    width: size * 0.4,
                    backgroundColor: "#FFF",
                    boxShadow: `0 0 0 3px ${color}`,
                    borderRadius: size * 0.2,
                }}
            >
                {props.detail?.input.type === "qr" ? <QrIcon /> : null}
                {props.detail?.input.type === "picture" ? <CameraIcon /> : null}
                {props.detail?.input.type === "audio" ? <AudioIcon /> : null}
                {props.detail?.input.type === "form" ? <FormIcon /> : null}
            </div>
            <div
                style={{
                    height: size * 0.1,
                    width: size * 0.1,
                    borderStyle: "solid",
                    borderColor: `${color} transparent transparent transparent`,
                    borderWidth: `${size * 0.1}px ${size * 0.05}px 0 ${
                        size * 0.05
                    }px`,
                    margin: "auto",
                }}
            ></div>
        </div>
    );
};

export default Marker;

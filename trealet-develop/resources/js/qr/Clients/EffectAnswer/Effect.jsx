import React, { useEffect, useState } from "react";
import CheckCircleIcon from "@mui/icons-material/CheckCircle";
import ClearIcon from "@mui/icons-material/Clear";
import { Button, Typography } from "@mui/material";
import { pink } from "@mui/material/colors";
import { display } from "@mui/system";
// import Audio from "../../assets/audios/correct.mp3"
// import correct from "../../assets/audios/correct.mp3";
// import wrong from "../../assets/audios/wrong.mp3";

const Effect = (props) => {
    const { status, data, closeEffect } = props;
    //   const [audio] = useState(new Audio(status ? correct : wrong));
    //   useEffect(() => {
    //     // audio.play();
    //     // const audio = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');
    //     audio.play();
    //   }, []);
    // const audioClick = () => {
    //     audio.play();
    // };
    return (
        <>
            <div
                style={{
                    position: "fixed",
                    left: 0,
                    right: 0,
                    bottom: 0,
                    top: 0,
                    background: "rgba(240, 240, 240,1)",
                }}
                // onClick={audioClick}
            >
                <div
                    style={{
                        display: "flex",
                    }}
                >
                    <Button
                        className="bx "
                        variant="contained"
                        style={{ margin: "10px auto" }}
                        color="success"
                        onClick={() => closeEffect()}
                    >
                        Tiếp tục
                    </Button>
                </div>
                {status ? (
                    <div
                        style={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                        }}
                    >
                        <div>
                            <CheckCircleIcon
                                color="success"
                                sx={{ fontSize: 100 }}
                            />
                        </div>
                        <Typography style={{ color: "#2e7d32" }} component="p">
                            {" "}
                            CORRECT
                        </Typography>
                    </div>
                ) : (
                    <div
                        style={{
                            display: "flex",
                            justifyContent: "center",
                            alignItems: "center",
                        }}
                    >
                        <div>
                            <ClearIcon
                                sx={{ fontSize: 100, color: pink[500] }}
                            />
                        </div>
                        <Typography component="p" style={{ color: "#e91e63" }}>
                            WRONG
                        </Typography>
                    </div>
                )}
                <div>
                    <div
                        style={{
                            marginTop: 30,
                            display: "flex",
                            justifyContent: "center",
                            fontSize: 30,
                            fontWeight: "bold",
                        }}
                    >
                        Lời giải thích :
                    </div>
                    <p style={{ marginLeft: 10, marginRight: 10 }}>
                        {data?.descriptionAnswer}
                    </p>
                </div>
            </div>
        </>
    );
};

export default Effect;

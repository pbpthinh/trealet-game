import React, { useState, useRef, useEffect } from "react";
import { Carousel, Menu, Alert } from "antd";
import { EnvironmentOutlined, CameraOutlined } from "@ant-design/icons";
import MarkerInfo from "./MarkerInfo";
import MarkerUpload from "./MarkerUpload";
import { Drawer, Button } from "rsuite";
import { Message, toaster } from "rsuite";
import { getMaps, getGps, getKm, setIsUpdating } from "../action";
import { useSelector, useDispatch } from "react-redux";
import select from "../../../utils/select";

const { SubMenu } = Menu;

const MarkerDetail = ({ detail, onShowDetail, isShowDetail }) => {
    const trId = window.location.search.replace("?tr=", "");
    const { isFetching, maps, isUpdating } = useSelector((state) => ({
        isFetching: select(state, "mapsReducer", "isFetching"),
        maps: select(state, "mapsReducer", "maps"),
        isUpdating: select(state, "mapsReducer", "isUpdating"),
    }));
    const dispatch = useDispatch();
    const ref = useRef();

    const [updatCheckIn, setUpdatCheckIn] = useState(false);

    const onClose = () => {
        onShowDetail(false, null);
        setCurrent("info");
    };

    useEffect(() => {
        setUpdatCheckIn(false);
    }, [detail]);

    const handleClickUpdate = () => {
        dispatch(setIsUpdating(true));
    };

    const handleClickDone = () => {
        dispatch(setIsUpdating(false));
    };

    const renderIframeInput = (detail) => {
        switch (detail?.input.type) {
            case "picture":
                return (
                    <div>
                        <iframe
                            frameBorder="0"
                            style={{
                                position: "relative",
                                height:
                                    window.innerWidth - 34 > 400
                                        ? 300
                                        : (window.innerWidth - 34) * 0.75,
                                borderRadius: 7,
                            }}
                            src={`${window.location.origin}/input-picture?tr_id=${trId}&nij=${detail?.index}`}
                            title="picture"
                            allow="camera"
                            width={window.innerWidth - 34}
                        />
                    </div>
                );
            case "audio":
                return (
                    <div>
                        <iframe
                            frameBorder="0"
                            style={{
                                position: "relative",
                                height: 212,
                                borderRadius: 7,
                            }}
                            src={`${window.location.origin}/input-audio?tr_id=${trId}&nij=${detail?.index}`}
                            title="audio"
                            allow="microphone"
                            width={window.innerWidth - 34}
                        />
                    </div>
                );
            case "qr":
                return (
                    <div>
                        <iframe
                            onLoad={(e) => console.log(e)}
                            frameBorder="0"
                            style={{
                                position: "relative",
                                height:
                                    window.innerWidth - 54 > 400
                                        ? 339
                                        : (window.innerWidth - 54) * 0.75 + 39,
                                borderRadius: 7,
                            }}
                            src={`${window.location.origin}/input-qr?tr_id=${trId}&nij=${detail?.index}`}
                            title="Scan QR code from camera"
                            allow="camera"
                            width={window.innerWidth - 34}
                        />
                    </div>
                );
            case "form":
                return (
                    <div>
                        <iframe
                            ref={ref}
                            frameBorder="0"
                            style={{
                                position: "relative",
                                height: 276,
                            }}
                            src={`${window.location.origin}/input-form?tr_id=${trId}&nij=${detail?.index}`}
                            title="Input data from a form"
                            width={window.innerWidth - 34}
                        />
                    </div>
                );
            default:
                return null;
        }
    };

    const renderViewInput = (detail) => {
        switch (detail?.input.type) {
            case "picture":
                return (
                    <div
                        style={{
                            width: window.innerWidth - 34,
                            height: "auto",
                            marginTop: 15,
                        }}
                    >
                        <h6 style={{ margin: 10 }}>Ảnh bạn đã gửi:</h6>
                        <img
                            src={`${window.location.origin}/${maps[detail?.index]?.data
                                }`}
                        />
                    </div>
                );
            case "audio":
                return (
                    <div
                        style={{ width: window.innerWidth - 34, marginTop: 15 }}
                    >
                        <h6 style={{ margin: 10 }}>Audio bạn đã gửi:</h6>
                        <audio controls>
                            <source
                                src={`${window.location.origin}/${maps[detail?.index]?.data
                                    }`}
                                type="audio/ogg"
                            />
                        </audio>
                    </div>
                );
            case "qr":
                return (
                    <div style={{ marginTop: 15 }}>
                        <h6 style={{ margin: 10 }}>Thông tin QR của bạn : </h6>
                        <Message type="info" style={{ marginBottom: 15 }}>
                            {maps[detail?.index]?.data.scanneddata}
                        </Message>
                    </div>
                );
            case "form":
                return (
                    <div style={{ marginTop: 15 }}>
                        <h6 style={{ margin: 10 }}>Nội dung bạn đã gửi :</h6>
                        <Message type="info" style={{ marginBottom: 15 }}>
                            {maps[detail?.index]?.data.comment}
                        </Message>
                    </div>
                );
            default:
                return null;
        }
    };

    return (
        <div
            style={{ margin: 17, justifyContent: "center", overflowY: "auto" }}
        >
            <h5 style={{ textAlign: "center", marginBottom: 20 }}>
                {detail?.name}
            </h5>
            <div>
                {!maps[detail?.index]?.played || isUpdating ? (
                    <div style={{ marginTop: 15 }}>
                        <Message type="warning" style={{ marginBottom: 15 }}>
                            {detail?.desc}
                        </Message>
                        <div style={{ marginTop: 15 }}>
                            {maps[detail?.index]?.videoUrl ?
                                (<video
                                    controls
                                    type="video/mp4"
                                    width={window.innerWidth - 34 > 600 ? 600 : window.innerWidth - 34}
                                    src={`${window.location.origin}/${maps[detail?.index]?.videoUrl?.replace('../', '')}`}
                                >
                                </video>) : null
                            }
                            {maps[detail?.index]?.imgUrl ?
                                (<img
                                    width={window.innerWidth - 34 > 600 ? 600 : window.innerWidth - 34}
                                    src={`${window.location.origin}/${maps[detail?.index]?.imgUrl?.replace('../', '')}`}
                                />) : null
                            }
                        </div>
                        <h6 style={{ marginTop: 15, marginLeft: 10, marginBottom: 8 }}>{`${detail?.input.label} : `}</h6>
                        {renderIframeInput(detail)}
                        {isUpdating ? (
                            <Button
                                appearance="primary"
                                onClick={handleClickDone}
                                style={{ marginTop: 15 }}
                            >
                                {"Cancel"}
                            </Button>
                        ) : null}
                    </div>
                ) : (
                    <div style={{ marginTop: 15 }}>
                        <Alert
                            message="Bạn đã hoàn thành trò chơi tại đây"
                            type="success"
                            showIcon
                        />
                        <Message type="warning" style={{ marginTop: 15 }}>
                            {detail?.desc}
                        </Message>
                        <div style={{ marginTop: 15 }}>
                            {maps[detail?.index]?.videoUrl ?
                                (<video
                                    controls
                                    type="video/mp4"
                                    width={window.innerWidth - 34 > 600 ? 600 : window.innerWidth - 34}
                                    src={`${window.location.origin}/${maps[detail?.index]?.videoUrl?.replace('../', '')}`}
                                >
                                </video>) : null
                            }
                            {maps[detail?.index]?.imgUrl ?
                                (<img
                                    width={window.innerWidth - 34 > 600 ? 600 : window.innerWidth - 34}
                                    src={`${window.location.origin}/${maps[detail?.index]?.imgUrl?.replace('../', '')}`}
                                />) : null
                            }
                        </div>
                        {isFetching
                            ? renderViewInput(null)
                            : renderViewInput(detail)}
                        <Button
                            appearance="ghost"
                            onClick={handleClickUpdate}
                            style={{ marginTop: 15 }}
                        >
                            Update
                        </Button>
                    </div>
                )}
            </div>
        </div>
    );
};

export default MarkerDetail;
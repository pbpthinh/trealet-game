import React, { useEffect, useRef, useState } from "react";
import PropTypes from "prop-types";
import { connect, useDispatch, useSelector } from "react-redux";
import { Layout, message } from "antd";
import MapView from "./components/MapView";
import MarkerDetail from "./components/MarkerDetail";
import { Button } from "rsuite";
import { getMaps, setIsUpdating } from "./action";
import select from "../../utils/select";
import toJs from "../../hoc/ToJS";
import ActionSheet, { ActionSheetRef } from "actionsheet-react";
import { Modal } from "rsuite";

const { Header, Footer, Sider, Content } = Layout;

const MapsScreen = () => {
    const { mapsInfo } = useSelector((state) => ({
        mapsInfo: select(state, "mapsReducer", "mapsInfo"),
    }));

    const dispatch = useDispatch();

    const [isShowDetail, setIsShowDetail] = useState(false);
    const [detail, setDetail] = useState(null);
    const [hello, setHello] = useState(false);

    const ref = useRef();

    const trId = window.location.search.replace("?tr=", "");

    useEffect(() => {
        dispatch(getMaps(trId));
    }, []);

    const onShowDetail = (e, detail) => {
        if (!e) {
            dispatch(getMaps(trId));
            ref.current.close();
        } else {
            ref.current.open();
            setDetail(detail);
        }
        setIsShowDetail(e);
    };

    const onMessageReceived = async (event) => {
        if (event.data.success) {
            await dispatch(getMaps(trId));
            dispatch(setIsUpdating(false));
        }
    };

    useEffect(() => {
        if (mapsInfo) {
            setHello(true);
        }
    }, [mapsInfo]);

    useEffect(() => {
        window.addEventListener("message", onMessageReceived, false);
    }, []);

    const close = () => {
        dispatch(getMaps(trId));
    };

    const handleClose = () => setHello(false);

    return (
        <div
            style={{
                marginTop: -23,
                minHeight: `calc(${window.innerHeight} - 263px)`,
                backgroundColor: "#fff",
            }}
        >
            <MapView onShowDetail={onShowDetail} />
            <ActionSheet
                ref={ref}
                sheetStyle={{
                    borderTopLeftRadius: 18,
                    borderTopRightRadius: 18,
                }}
                sheetStyle={{ height: "68vh" }}
                bgStyle={{
                    backgroundColor: "rgba(1, 1, 1, 0.8)",
                }}
                sheetTransition={"transform 0.2s ease-in-out"}
                onClose={close}
            >
                <MarkerDetail
                    isShowDetail={isShowDetail}
                    onShowDetail={onShowDetail}
                    detail={detail}
                />
            </ActionSheet>
            <Modal
                full
                open={hello}
                onClose={handleClose}
                style={{ marginTop: "8vh" }}
            >
                <Modal.Header>
                    <Modal.Title>
                        <h5>Xin chào</h5>
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div style={{ height: "50vh" }}>
                        <h6>{mapsInfo?.title}</h6>
                        <p style={{marginTop: 20}}>{mapsInfo?.desc}</p>
                    </div>
                </Modal.Body>
                {/* <Modal.Footer>
                    <h6 style={{ marginTop: 15 }}>
                       213123213
                    </h6>
                </Modal.Footer> */}
            </Modal>
        </div>
    );
};

export default toJs(MapsScreen);

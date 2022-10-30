import React, { useState, useEffect, useRef, useCallback } from "react";
import { useSelector, useDispatch } from "react-redux";
import GoogleMap from "google-map-react";
import GpsIcon from "../../../components/icons/GpsIcon";
import RankingIcon from "../../../components/icons/RankingIcon";
import MapsIcon from "../../../components/icons/MapsIcon";
import GeoIcon from "../../../components/icons/GeoIcon";
import DoneIcon from "../../../components/icons/DoneIcon";
import Marker from "../../../components/Marker";
import { getMaps, getGps, getKm, setZooCenter } from "../action";
import select from "../../../utils/select";
import { getDistanceFromLatLonInKm } from "../../../utils/util";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import Polyline from "./Polyline";
import { Modal, Message } from "rsuite";

const boxMenu = {
    position: "relative",
    height: 30,
    borderRadius: 15,
    backgroundColor: "#FFF",
    justifyContent: "center",
    boxShadow:
        "rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px",
    alignItems: "center",
    display: "flex",
};

const boxNoti = {
    position: "relative",
    height: 45,
    borderRadius: 7,
    justifyContent: "center",
    boxShadow:
        "rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px",
    alignItems: "center",
    display: "flex",
};

const MapView = (props) => {
    const trId = window.location.search.replace("?tr=", "");
    const {
        maps,
        gps,
        isGps,
        ganNhat,
        km,
        center,
        zoom,
        info,
        listPlayer,
        isUpdating,
    } = useSelector((state) => ({
        maps: select(state, "mapsReducer", "maps"),
        gps: select(state, "mapsReducer", "gps"),
        isGps: select(state, "mapsReducer", "isGps"),
        ganNhat: select(state, "mapsReducer", "ganNhat"),
        km: select(state, "mapsReducer", "km"),
        center: select(state, "mapsReducer", "center"),
        zoom: select(state, "mapsReducer", "zoom"),
        info: select(state, "mapsReducer", "info"),
        listPlayer: select(state, "mapsReducer", "listPlayer"),
        isUpdating: select(state, "mapsReducer", "isUpdating"),
    }));

    const dispatch = useDispatch();

    useEffect(() => {
        const intervalGps = setInterval(() => {
            dispatch(getGps(navigator));
        }, 777);
        return () => clearInterval(intervalGps);
    }, []);

    useEffect(() => {
        const interval = setInterval(() => {
            dispatch(getKm());
        }, 5000);
        return () => clearInterval(interval);
    }, []);

    const changeMap = ({ center, zoom, bounds }) => {
        dispatch(setZooCenter(zoom, center));
    };

    const [mapApi, setMapApi] = useState(null);
    const [mapsApi, setMapsApi] = useState(null);
    const [mapsLoaded, setMapsLoaded] = useState(false);

    const onMapLoaded = (mapLoad, mapsLoad) => {
        if (maps.length > 0 && mapsLoaded === false) {
            setMapsLoaded(true);
            setMapApi(mapLoad);
            setMapsApi(mapsLoad);
        }
    };

    const afterMapLoadChanges = () => {
        if (
            mapsLoaded &&
            mapsApi !== null &&
            mapApi !== null &&
            maps.length > 0
        ) {
            return (
                <div>
                    <Polyline map={mapApi} maps={mapsApi} markers={maps} />
                </div>
            );
        }
    };

    const onCenterOld = () => {
        let lat = 0;
        let lng = 0;
        maps.forEach((map) => {
            lat += parseFloat(map.lat);
            lng += parseFloat(map.lng);
        });
        let newCenter = {
            lat: lat / maps.length,
            lng: lng / maps.length,
        };
        dispatch(setZooCenter(17, newCenter));
    };

    const [open, setOpen] = React.useState(false);
    const [myPlay, setMyPlay] = React.useState(false);

    const handleOpen = async () => {
        const trId = window.location.search.replace("?tr=", "");
        await dispatch(getMaps(trId));
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const handleOpenMyPlay = () => {
        setMyPlay(true);
    };

    const handleCloseMyPlay = () => {
        setMyPlay(false);
    };

    return (
        <div
            style={{
                height: window.innerHeight - 72,
                width: "100%",
            }}
        >
            <GoogleMap
                path={maps}
                bootstrapURLKeys={{
                    key: "AIzaSyDaN01Pp4i8Q-JFCHFlWuYWhexqj-tNHy0",
                }}
                options={{
                    keyboardShortcuts: false,
                    gestureHandling: "greedy",
                    disableDefaultUI: true,
                    disableDoubleClickZoom: true,
                    streetViewControl: false,
                    clickableIcons: false,
                    fullscreenControl: false,
                    style: [
                        {
                            featureType: "poi",
                            stylers: [{ visibility: "off" }],
                        },
                        {
                            featureType: "transit",
                            stylers: [{ visibility: "off" }],
                        },
                        {
                            featureType: "landscape",
                            stylers: [{ visibility: "off" }],
                        },
                    ],
                }}
                center={center}
                zoom={zoom}
                gestureHandling={false}
                onChange={changeMap}
                onGoogleApiLoaded={({ map, maps }) => onMapLoaded(map, maps)}
                yesIWantToUseGoogleMapApiInternals={true}
            >
                {mapsLoaded ? afterMapLoadChanges() : null}

                {maps.map((item, index) => {
                    let detail = item;
                    detail.index = index;
                    return (
                        <Marker
                            zoom={zoom}
                            key={index}
                            detail={detail}
                            lat={item.lat}
                            lng={item.lng}
                            onClickMarker={props.onShowDetail}
                        />
                    );
                })}
                {gps !== null ? <GpsIcon lat={gps.lat} lng={gps.lng} /> : null}
            </GoogleMap>
            <div
                style={Object.assign(
                    {
                        width: window.innerWidth - 50,
                        position: "relative",
                        top: -(window.innerHeight - 82),
                        marginLeft: 25,
                        textAlign: "center",
                        backgroundColor: !isGps ? "#FFFBC2" : "#FFF",
                    },
                    boxNoti
                )}
            >
                <div
                    style={{
                        whiteSpace: "pre-wrap",
                        overflowWrap: "break-word",
                        width: "95%",
                    }}
                >
                    {!isGps ? (
                        <p>
                            Bạn đang tắt GPS vui lòng mở GPS và cho phép lấy vị
                            trí
                        </p>
                    ) : ganNhat ? (
                        <p>{`Vị trí của của bạn cách ${
                            ganNhat?.name ? ganNhat?.name : ""
                        } ${
                            km < 1
                                ? `${(km * 1000).toFixed(1)} m`
                                : `${km.toFixed(1)} km`
                        }`}</p>
                    ) : (
                        <p>Đang xác định vị trí</p>
                    )}
                </div>
            </div>
            <div
                style={Object.assign(
                    {
                        width: 40,
                        position: "relative",
                        top: -85,
                        left: 10,
                    },
                    boxMenu
                )}
                onClick={handleOpen}
            >
                <RankingIcon></RankingIcon>
            </div>
            <div
                style={Object.assign(
                    {
                        width: 130,
                        position: "relative",
                        top: -115,
                        left: (window.innerWidth - 130) / 2,
                        right: 100,
                    },
                    boxMenu
                )}
            >
                <div
                    onClick={handleOpenMyPlay}
                    style={{
                        flexDirection: "row",
                        display: "flex",
                        justifyContent: "space-between",
                        alignItems: "center",
                    }}
                >
                    <DoneIcon style={{ width: "15%" }}></DoneIcon>
                    <div style={{ width: "70%", textAlign: "center" }}>
                        <h6>
                            {` ${
                                info?.count
                                    ? info?.count
                                    : info === null
                                    ? "0"
                                    : "?"
                            } | 
										${maps.length ? maps.length : "?"} `}
                        </h6>
                    </div>

                    <GeoIcon style={{ width: "15%" }}></GeoIcon>
                </div>
            </div>
            <div
                style={Object.assign(
                    {
                        width: 40,
                        position: "relative",
                        top: -145,
                        right: -(window.innerWidth - 50),
                    },
                    boxMenu
                )}
                onClick={() => {
                    if (
                        window.confirm(
                            "Bạn có muốn quay lại bản đồ chính của Trealet ?"
                        )
                    )
                        onCenterOld();
                }}
            >
                <MapsIcon></MapsIcon>
            </div>

            <Modal
                full
                open={open}
                onClose={handleClose}
                style={{ marginTop: "10vh" }}
            >
                <Modal.Header>
                    <Modal.Title>
                        <h5>Xếp hạng</h5>
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div style={{ height: "55vh" }}>
                        {listPlayer.map((player, index) => (
                            <div
                                key={index}
                                style={{
                                    padding: 15,
                                    marginTop: 10,
                                    color: "#FFF",
                                    borderRadius: 10,
                                    backgroundColor:
                                        player.userId === info?.userId
                                            ? "#1F7D1F"
                                            : "#5E219A",
                                }}
                            >
                                <h6>
                                    {`Hạng ${index + 1} :  ${ player.username == null ? player.firstName + ' ' + player.lastName : player.username}`}
                                </h6>
                                <h6>
                                    {`Đã check in ${player?.count} / ${maps.length} vị trí`}
                                </h6>
                            </div>
                        ))}
                    </div>
                </Modal.Body>
            </Modal>

            <Modal
                full
                open={myPlay}
                onClose={handleCloseMyPlay}
                style={{ marginTop: "8vh" }}
            >
                <Modal.Header>
                    <Modal.Title>
                        <h5>Chi tiết</h5>
                    </Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div style={{ height: "55vh" }}>
                        {maps.map((myPlay, index) => (
                            <div
                                key={index}
                                style={{
                                    padding: 10,
                                    marginTop: 10,
                                    borderRadius: 10,
                                    backgroundColor:
                                        myPlay.played
                                            ? "#D2FFD4"
                                            : "#FBD2D0",
                                }}
                            >
                                <h6>
                                    {myPlay.name}
                                </h6>
                                <p>
                                    {myPlay.played ? 'Đã hoàn thành' : 'Chưa hoàn thành'}
                                </p>
                            </div>
                        ))}
                    </div>
                </Modal.Body>
                <Modal.Footer>
                    <h6 style={{ marginTop: 15 }}>
                        {`Bạn đã check in tại : ${info?.count == undefined ? 0 : info?.count} / ${maps.length} vị trí`}
                    </h6>
                </Modal.Footer>
            </Modal>
        </div>
    );
};

export default MapView;

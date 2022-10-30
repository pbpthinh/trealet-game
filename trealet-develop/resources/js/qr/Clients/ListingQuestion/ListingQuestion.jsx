import {
    Card,
    Dialog,
    Grid,
    IconButton,
    Menu,
    Typography,
} from "@mui/material";
import LockIcon from "@mui/icons-material/Lock";
import EmojiEventsIcon from "@mui/icons-material/EmojiEvents";
import DangerousIcon from "@mui/icons-material/Dangerous";

import React, { useContext, useState } from "react";
import ResultQuestion from "../ResultQuestion/ResultQuestion";
import { CountContext } from "../../components/CountProvider";

const ListingQuestion = (props) => {
    const { data, questionIds } = props;
    const [open, setOpen] = useState(false);
    const [questionActive, setQuestionActive] = useState();
    const [title, setTitle] = useState("");
    const [anchorEl, setAnchorEl] = React.useState(null);
    const openMenu = Boolean(anchorEl);
    const { answered } = useContext(CountContext);
    console.log("answered", answered);
    const handClickNoScanner = (event, value) => {
        setAnchorEl(event.currentTarget);
        setTitle(value?.location);
    };
    const handleClose = () => {
        setAnchorEl(null);
    };
    const handleClick = (item) => {
        setQuestionActive(item);
        setOpen(true);
    };
    console.log(questionActive);
    const onClose = () => {
        setOpen(false);
        setQuestionActive(null);
    };
    return (
        <div>
            <Grid container spacing={2}>
                {!!data &&
                    data?.items.map((v, index) => {
                        const checkScanner = questionIds.includes(v.id);
                        const checkCorrect = answered.correct.includes(v.id);
                        const checkWrong = answered.wrong.includes(v.id);
                        console.log(checkCorrect);
                        if (checkScanner) {
                            return (
                                <Grid key={index} item xs={3}>
                                    <Card
                                        style={{
                                            display: "flex",
                                            justifyItems: "center",
                                            justifyContent: "center",
                                            textAlign: "center",
                                            height: 100,
                                            background: checkCorrect
                                                ? "#7CFC00"
                                                : "#FF0000",
                                        }}
                                    >
                                        {checkCorrect ? (
                                            <IconButton>
                                                <EmojiEventsIcon
                                                    style={{
                                                        width: 50,
                                                        height: 50,
                                                        fill: "yellow",
                                                    }}
                                                />
                                            </IconButton>
                                        ) : checkWrong ? (
                                            <IconButton>
                                                <DangerousIcon
                                                    style={{
                                                        width: 50,
                                                        height: 50,
                                                        fill: "white",
                                                    }}
                                                />
                                            </IconButton>
                                        ) : (
                                            <IconButton
                                                onClick={() => handleClick(v)}
                                            >
                                                <LockIcon
                                                    style={{
                                                        width: 50,
                                                        height: 50,
                                                        fill: "white",
                                                    }}
                                                />
                                            </IconButton>
                                        )}
                                    </Card>
                                </Grid>
                            );
                        } else {
                            return (
                                <Grid key={index} item xs={3}>
                                    <Card
                                        style={{
                                            display: "flex",
                                            justifyItems: "center",
                                            justifyContent: "center",
                                            textAlign: "center",
                                            height: 100,
                                            background: "#6c4298",
                                        }}
                                        onClick={(e) =>
                                            handClickNoScanner(e, v)
                                        }
                                    >
                                        <IconButton>
                                            <LockIcon
                                                style={{
                                                    width: 50,
                                                    height: 50,
                                                    fill: "white",
                                                }}
                                            />
                                        </IconButton>
                                    </Card>
                                </Grid>
                            );
                        }
                    })}
            </Grid>
            <Menu
                id="basic-menu"
                anchorEl={anchorEl}
                open={openMenu}
                onClose={handleClose}
                MenuListProps={{
                    "aria-labelledby": "basic-button",
                }}
            >
                <Typography variant="body2" style={{ padding: 10 }}>
                    Hãy đến {title} quét mã QR để trả lời câu hỏi
                </Typography>
            </Menu>
            {open && (
                <ResultQuestion
                    open={open}
                    onClose={onClose}
                    data={questionActive}
                />
            )}
        </div>
    );
};

export default ListingQuestion;

import React, { useContext, useEffect, useState } from "react";
import { CountContext } from "../components/CountProvider";
import Success from "./ResultQuestion/Success";

const Count = (props) => {
    const { data } = props;
    const { answered } = useContext(CountContext);
    const [open, setOpen] = useState(false);
    const onClose = () => {
        setOpen(false);
    };
    useEffect(() => {
        setOpen(
            data?.items.length ===
                answered.correct.length + answered.wrong.length
        );
    }, [data, answered]);

    return (
        <div
            style={{
                display: "flex",
                justifyContent: "space-around",
                padding: "10px",
                color: "green",
            }}
        >
            <div>Số câu trả lời đúng {answered.correct.length}</div>
            <div>
                Đã trả lời được{" "}
                {answered.correct.length + answered.wrong.length}
            </div>
            {open && <Success open={open} onClose={onClose} />}
        </div>
    );
};

export default Count;

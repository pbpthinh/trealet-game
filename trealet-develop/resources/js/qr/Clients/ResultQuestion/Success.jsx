import {
  Alert,
  Button,
  Dialog,
  DialogActions,
  DialogContent,
} from "@mui/material";
import React, { useContext, useState } from "react";
import { CountContext } from "../../components/CountProvider";

const Success = (props) => {
  const { open, onClose } = props;
  const { answered } = useContext(CountContext);

  return (
    <Dialog open={open} onClose={onClose} fullScreen>
      {/* <DialogTitle>
      <div className={classes.root}>
        <LinearProgressWithLabel value={bar} />
        <Button onClick={() => setBar(bar + 1)}>Increase +5</Button>
      </div>
    </DialogTitle> */}
      <DialogContent>
        <div className="container">
          <div className="question-container">
            <div className="question-box">
              CHúc mừng bạn đã hoàn thành trả lời câu hỏi
            </div>
            <div
              className="question-box"
              style={{ backgroundColor: "green", marginTop: 30 }}
            >
              Điểm số {answered.correct.length}/
              {answered.wrong.length + answered.correct.length}
            </div>
          </div>
        </div>
      </DialogContent>
      <DialogActions>
        <Button
          style={{ backgroundColor: "green", color: "white" }}
          onClick={() => onClose()}
        >
          Thoát
        </Button>
      </DialogActions>
    </Dialog>
  );
};

export default Success;

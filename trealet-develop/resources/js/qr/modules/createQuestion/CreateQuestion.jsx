import ImageIcon from "@mui/icons-material/Image";
import MicIcon from "@mui/icons-material/Mic";
import VideocamIcon from "@mui/icons-material/Videocam";
import DeleteIcon from "@mui/icons-material/Delete";
import CheckCircleOutlineIcon from "@mui/icons-material/CheckCircleOutline";
import AddIcon from "@mui/icons-material/Add";
import LinkIcon from '@mui/icons-material/Link';
import {
  Box,
  Button,
  Card,
  FormControl,
  Grid,
  IconButton,
  InputLabel,
  MenuItem,
  Paper,
  Select,
  TextField,
  Tooltip,
  Typography,
} from "@mui/material";

import React from "react";

const CreateQuestion = () => {
  return (
    <React.Fragment>
      <Box
        sx={{
          minWidth: 120,
          display: "flex",
          justifyContent: "end",
          height: 60,
        }}
      >
        <FormControl size="small">
          <InputLabel id="demo-simple-select-label">Dạng</InputLabel>
          <Select
            labelId="demo-simple-select-label"
            id="demo-simple-select"
            value={10}
            label="Age"
          >
            <MenuItem value={10}>Trắc Nghiệm</MenuItem>
            <MenuItem value={20}>Điền Ô</MenuItem>
          </Select>
        </FormControl>
      </Box>
      <Paper elevation={3} style={{width:'100%'}}>
        <Grid container spacing={2}>
          <Grid item xs={1} md={1} spacing={2}>
            <Card style={{ marginLeft: 10, paddingTop: 10 }}>
              <Box>
                <ImageIcon style={{ marginLeft: 14 }} />
                <Typography variant="body2">Hình ảnh</Typography>
              </Box>
              <Box>
                <MicIcon style={{ marginLeft: 14 }} />
                <Typography variant="body2">Âm thanh</Typography>
              </Box>
              <Box>
                <LinkIcon style={{ marginLeft: 14 }} />
                <Typography variant="body2">Video</Typography>
              </Box>
            </Card>
          </Grid>
          <Grid item xs={11} md={11}>
            <FormControl
              style={{
                width: "98%",
              }}
            >
              <TextField
                multiline={true}
                size="medium"
                placeholder="Nhập câu hỏi của bạn tại đây"
                rows={6}
                variant="outlined"
              />
            </FormControl>
          </Grid>
          <Grid item xs={11} md={11}>
            <Tooltip title="Thêm câu hỏi">
              <IconButton>
                <AddIcon />
              </IconButton>
            </Tooltip>
          </Grid>
          {[0, 1, 2, 3].map((v) => (
            <Grid
              key={v}
              item
              xs={3}
              md={3}
              style={{
                display: "flex",
                justifyContent: "space-around",
                marginBottom: 20,
              }}
            >
              <Paper
                elevation={3}
                style={{
                  backgroundColor: "rgba(59, 130, 246, 0.5)",
                  width: "90%",
                }}
              >
                <FormControl>
                  <div
                    style={{ display: "flex", justifyContent: "space-between" }}
                  >
                    <div
                      style={{
                        display: "flex",
                        justifyContent: "space-between",
                        width: 60,
                      }}
                    >
                      <DeleteIcon />
                      <ImageIcon />
                    </div>
                    <div>
                      <CheckCircleOutlineIcon />
                    </div>
                  </div>
                  <TextField
                    multiline={true}
                    style={{
                      display: "flex",
                      justifyContent: "center",
                      marginLeft: 40,
                    }}
                    size="medium"
                    placeholder="Nhập câu trả lời tùy chọn tại đây"
                    rows={10}
                    variant="standard"
                  />
                </FormControl>
              </Paper>
            </Grid>
          ))}
        </Grid>
        <Grid item xs={12} md={12}>
          <div
            style={{ display: "flex", justifyContent: "end", marginRight: 10 }}
          >
            <Button
              color="inherit"
              variant="contained"
              style={{ marginBottom: 20 }}
            >
              Hủy
            </Button>
            <Button
              variant="contained"
              style={{ marginBottom: 20 ,marginLeft:20 }}
              color="success"
            >
              Lưu
            </Button>
          </div>
        </Grid>
      </Paper>
    </React.Fragment>
  );
};

export default CreateQuestion;

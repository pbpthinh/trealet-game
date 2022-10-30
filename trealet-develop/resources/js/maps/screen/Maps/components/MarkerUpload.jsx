import React, { useState } from "react";
import {
  Upload,
  Space,
  Radio,
  Select,
  Input,
  Typography,
  Modal,
  Button,
} from "antd";
import { PlusOutlined } from "@ant-design/icons";
import AudioReactRecorder, { RecordState } from "audio-react-recorder";

const { Option, OptGroup } = Select;
const { TextArea } = Input;
const { Text, Link } = Typography;

function MarkerUpload(props) {
  const [file, setFile] = useState("image or video");
  const [files, setFiles] = useState({
    previewVisible: false,
    previewImage: "",
    previewTitle: "",
    fileList: [
      {
        uid: "-1",
        name: "image.png",
        status: "done",
        url: "https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png",
      },
    ],
  });

  const [recordState, setRecordState] = useState(null);

  const getBase64 = (file) => {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = (error) => reject(error);
    });
  };
  const handleCancel = () => {
    let tmp = files;
    tmp.previewVisible = false;
    console.log(tmp);
    setFiles(tmp);
  };

  const handlePreview = async (file) => {
    if (!file.url && !file.preview) {
      file.preview = await getBase64(file.originFileObj);
    }

    setFiles({
      previewImage: file.url || file.preview,
      previewVisible: true,
      previewTitle:
        file.name || file.url.substring(file.url.lastIndexOf("/") + 1),
    });
  };

  const handleChangeFile = ({ fileList }) => {
    let tmp = files;
    tmp.fileList = fileList;
    setFiles(tmp);
  };

  const handleChange = (value) => {
    setFile(value);
    console.log(`selected ${value}`);
  };

  const onChange = ({ fileList: newFileList }) => {
    setFiles(newFileList);
  };

  const start = () => {
    setRecordState(RecordState.START);
  };

  const stop = () => {
    console.log("hihu");
    setRecordState(RecordState.START);
  };

  //audioData contains blob and blobUrl
  const onStop = (audioData) => {
    console.log("audioData", audioData);
  };

  const uploadButton = (
    <div>
      <PlusOutlined />
      <div style={{ marginTop: 8 }}>Upload</div>
    </div>
  );

  return (
    <div style={{ marginTop: 15 }}>
      <Space direction="vertical" style={{ width: "100%" }}>
        <Text>Title :</Text>
        <Input placeholder="Title" />
        <Text>File Upload :</Text>
        <Select
          defaultValue="image or video"
          style={{ width: 200 }}
          onChange={handleChange}
        >
          <Option value="image or video">image or video</Option>
          <Option value="audio">audio</Option>
        </Select>

        <div className="space-align-block">
          {file !== "audio" ? (
            <>
              {" "}
              <Upload
                action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
                listType="picture-card"
                fileList={files.fileList}
                onPreview={handlePreview}
                onChange={handleChangeFile}
              >
                uploadButton
                {/* {files.fileList.length >= 8 ? null : uploadButton} */}
              </Upload>
              <Modal
                visible={files.previewVisible}
                title={files.previewTitle}
                footer={null}
                onCancel={handleCancel}
              >
                <img
                  alt="example"
                  style={{ width: "100%" }}
                  src={files.previewImage}
                />
              </Modal>
            </>
          ) : (
            <div
              style={{
                justifyContent: "center",
                alignItems: "center",
              }}
            >
              <AudioReactRecorder
                state={recordState}
                onStop={onStop}
                canvasWidth={300}
              />
              <Space>
                <Button type="primary" onClick={start}>
                  start
                </Button>
                <Button onClick={stop}>stop</Button>
              </Space>
            </div>
          )}
        </div>
        <Text>Discreption:</Text>
        <TextArea placeholder="Discreption" rows={4} />
      </Space>
      <div style={{ marginTop: 15 }}>
        <Space>
          <Button type="primary">upload</Button>
          <Button>cancel</Button>
        </Space>
      </div>
    </div>
  );
}

export default MarkerUpload;

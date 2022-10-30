import CloseIcon from "@mui/icons-material/Close";
import QrCodeScannerIcon from "@mui/icons-material/QrCodeScanner";
import { IconButton } from "@mui/material";
import { Box, display } from "@mui/system";
import React, { useEffect, useState } from "react";
import ListingQuestion from "./ListingQuestion/ListingQuestion";
import QrScaner from "./QrCode/QrScanner";
import CountProvider from "../components/CountProvider";
import Count from "./Count";
import { getQuestion } from "../resources/rs.api";

const Clients = () => {
  const [data, setData] = useState();
  const [openQRCode, setOpenQrCode] = useState(false);
  const [questionIds, setQuestionIds] = useState([]);
  const id = window.location.href.split("/").at(-1);

  const fetchQuestion = async () => {
    const res = await getQuestion(id);
    if (res.status === 200) {
      setData(res?.data);
    }
  };
  useEffect(() => {
    fetchQuestion();
  }, []);
  return (
    <CountProvider>
      <>
        <Count data={data} />
        {openQRCode ? (
          <>
            <Box style={{ display: "flex", justifyContent: "end" }}>
              <IconButton onClick={() => setOpenQrCode(false)}>
                <CloseIcon />
              </IconButton>
            </Box>
            <QrScaner
              questionIds={questionIds}
              setQuestionIds={setQuestionIds}
              setOpenQrCode={setOpenQrCode}
            />
          </>
        ) : (
          <ListingQuestion data={data} questionIds={questionIds} />
        )}
        <Box
          style={{
            display: "block",
            position: "fixed",
            bottom: 0,
            marginLeft: 150,
          }}
        >
          <IconButton onClick={() => setOpenQrCode(true)}>
            <QrCodeScannerIcon style={{ width: 100, height: 100 }} />
          </IconButton>
        </Box>
      </>
    </CountProvider>
  );
};

export default Clients;

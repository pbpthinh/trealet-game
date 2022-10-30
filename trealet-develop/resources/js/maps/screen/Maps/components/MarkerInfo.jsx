import React from "react";
import { Carousel, Space, Typography } from "antd";

const contentStyle = {
  height: "300px",
  color: "#fff",
  lineHeight: "300px",
  textAlign: "center",
  background: "#364d79",
};

const { Title, Paragraph, Text, Link } = Typography;

function MarkerInfo({ detail }) {
  return (
    <div style={{ marginTop: 15 }}>
      <Title level={4}>{detail?.title}</Title>

      <Carousel effect="fade">
        <div>
          <img
            width={"auto"}
            height={300}
            src={detail?.img[0].src}
            alt="Logo"
          />
        </div>
        <div>
          <img
            width={"auto"}
            height={300}
            src={detail?.img[1].src}
            alt="Logo"
          />
        </div>
        {/* <div>
          <h3 style={contentStyle}>1</h3>
        </div>
        <div>
          <h3 style={contentStyle}>2</h3>
        </div> */}
      </Carousel>
      <Paragraph>{detail ? detail.discreption : null}</Paragraph>
    </div>
  );
}

export default MarkerInfo;

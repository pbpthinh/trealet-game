import * as React from "react";
import Link from "@mui/material/Link";
import Table from "@mui/material/Table";
import TableBody from "@mui/material/TableBody";
import TableCell from "@mui/material/TableCell";
import TableHead from "@mui/material/TableHead";
import TableRow from "@mui/material/TableRow";
import Title from "./Title";
import { Card } from "@mui/material";
import { getAll } from "../resources/rs.api";

// Generate Order Data
function createData(id, date, name, shipTo, paymentMethod, amount) {
  return { id, date, name, shipTo, paymentMethod, amount };
}

const rows = [
  createData(0, "16 Mar, 2019", "1 +1 =?", "2", "2,5,6,7", "Trắc nghiệm"),
  createData(1, "16 Mar, 2019", "1 +1 =?", "2", "4,5,6,7", "Trắc nghiệm"),
  createData(2, "16 Mar, 2019", "1 +1 =?", "2", "2,5,6,7", "Trắc nghiệm"),
  createData(3, "16 Mar, 2019", "1 +1 =?", "2", "2,5,6,7", "Trắc nghiệm"),
];

function preventDefault(event) {
  event.preventDefault();
}

export default function Orders() {
  const fetchData = async () => {
    try {
      const res = await getAll();
      console.log(res);
    } catch (error) {}
  };

  React.useEffect(() => {
    fetchData();
  }, []);
  return (
    <React.Fragment>
      <Card>
        <Title>Danh sách câu hỏi</Title>
        <Table size="small">
          <TableHead>
            <TableRow>
              <TableCell>Ngày</TableCell>
              <TableCell>Tên câu hỏi</TableCell>
              <TableCell>Câu hỏi đúng</TableCell>
              <TableCell>Danh sách sự lựa chọn</TableCell>
              <TableCell align="right"> Loại câu hỏi </TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {rows.map((row) => (
              <TableRow key={row.id}>
                <TableCell>{row.date}</TableCell>
                <TableCell>{row.name}</TableCell>
                <TableCell>{row.shipTo}</TableCell>
                <TableCell>{row.paymentMethod}</TableCell>
                <TableCell align="right">{`${row.amount}`}</TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </Card>
      {/* <Link color="primary" href="#" onClick={preventDefault} sx={{ mt: 3 }}>
        See more orders
      </Link> */}
    </React.Fragment>
  );
}

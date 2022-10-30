import { Route, Routes } from "react-router-dom";
import React from "react";
import Orders from "../dashboard/Orders";
import { CreateQuestion } from "../modules/createQuestion";

export const RouterApp = () => {
  return (
    <Routes>
      <Route path="list" element={<Orders />} />
      <Route path="create" element={<CreateQuestion />} />
    </Routes>
  );
};

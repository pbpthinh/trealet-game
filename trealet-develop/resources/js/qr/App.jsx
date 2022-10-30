import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Clients from "./Clients/Clients";
import { Main } from "./modules/main";
import "./App.css";
const App = () => {
    return (
        // <Routes>
        //     <Route path="/admin/*" element={<Main />}></Route>
        //     <Route path="/" element={<Clients />} />
        // </Routes>
        <>
            <Clients />
        </>
    );
};

export default App;

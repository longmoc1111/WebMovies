import React, { use, useEffect } from "react";
import { Navigate, Outlet } from "react-router-dom";
import axiosClient from "../../pages/axios-client";
import Header from "./Header";
import SideBar from "./SideBar";
import { useStateContext } from "../../contexts/ContextProvider";
export default function AdminLayout() {
  const { token, setUser } = useStateContext();
  if (!token) {
    return <Navigate to="/login" />;
  }
  useEffect(() => {
    axiosClient.get("/user").then(({ data }) => {
      setUser(data);
    });
  }, []);
  return (
    <>
      <Header />
      <SideBar />
      <Outlet />
    </>
  );
}

import React, { use, useEffect, useState } from "react";
import { Navigate, Outlet } from "react-router-dom";
import axiosClient from "@axios/axios-client";
import Header from "./header/Header";
import Sidebar from "./sidebar/Sidebar";
import { useStateContext } from "../../contexts/ContextProvider";
export default function AdminLayout() {
  const { token, setUser } = useStateContext();
  const [sidebarActive, setSidebarActive] = useState(false);
  if (!token) {
    return <Navigate to="/login" />;
  }
  useEffect(() => {
    axiosClient.get("/user").then(({ data }) => {
      setUser(data);
    });
  }, []);
  const toggleSidebar = () => {
    setSidebarActive((prev) => !prev);
  };
  return (
    <>
      <Header onToggleSidebar={toggleSidebar} active={sidebarActive} />
      <Sidebar active={sidebarActive} />
      <Outlet />
    </>
  );
}

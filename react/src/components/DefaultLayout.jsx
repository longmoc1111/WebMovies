import React, { use, useEffect } from "react";
import { Navigate, Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";
import { Link } from "react-router-dom";
import axios from "axios";
import axiosClient from "../views/axios-client";

export default function DefaultLayout() {
  const { user, token,setUser, setToken } = useStateContext();


  useEffect(() => {
  const headerBtn = document.querySelector('.header__btn');
  const headerNav = document.querySelector('.sidebar');

  function toggleHeaderMenu() {
    headerBtn.classList.toggle('header__btn--active');
    headerNav.classList.toggle('sidebar--active');
  }

  if (headerBtn) {
    headerBtn.addEventListener('click', toggleHeaderMenu);
  }

  // Cleanup để tránh nhân đôi khi StrictMode render 2 lần
  return () => {
    if (headerBtn) {
      headerBtn.removeEventListener('click', toggleHeaderMenu);
    }
  };
}, []);


  if (!token) {
    return <Navigate to="/login" />;
  }
  const onLogout = (ev) =>{
    ev.preventDefault()

    axiosClient.post('/logout')
    .then(()=> {
      setUser({})
      setToken(null)
    })
  }
  useEffect(() => {
    axiosClient.get('/user')
    .then(({data}) => {
      setUser( data)
    })
  },[])
 

  return (
    <>
      <header className="header">
        <div className="header__content">
          <a href="index.html" className="header__logo">
            <img src="img/logo.svg" alt="" />
          </a>

          <button className="header__btn" type="button">
            <span></span>
            <span></span>
            <span></span>
          </button> 
        </div>
      </header>

      <div className="sidebar">
        <a href="index.html" className="sidebar__logo">
          <img src="img/logo.svg" alt="" />
        </a>

        <div className="sidebar__user">
          <div className="sidebar__user-img">
            <img src="/img/user.svg" alt="" />
          </div>

          <div className="sidebar__user-title">
            <span>Admin</span>
            <p>{user.name}</p>
          </div>
          <form onSubmit={onLogout} className="sidebar__user-btn">
            <button className="sidebar__user-btn" type="submit">
              <i className="bi bi-box-arrow-right"></i>
            </button>
          </form>
        </div>

        <div className="sidebar__nav-wrap">
          <ul className="sidebar__nav">
            <li className="sidebar__nav-item">
              <Link to = '/DashBoard' className="sidebar__nav-link ">
                <i className="bi bi-grid"></i> <span>Dashboard</span>
              </Link>     
            </li>

            <li className="sidebar__nav-item">
              <Link to = "/movies" className="sidebar__nav-link ">
                <i className="bi bi-film"></i> <span>Quản lý phim</span>
              </Link>
            </li>

            <li className="sidebar__nav-item">
              <Link to = "/directors" className="sidebar__nav-link">
                <i className="bi bi-chat"></i> <span>Đạo diễn</span>
              </Link>
            </li>

            <li className="sidebar__nav-item">
              <a href="#" className="sidebar__nav-link">
                <i className="bi bi-chat"></i> <span>diễn viên</span>
              </a>
            </li>
            <li className="sidebar__nav-item">
              <Link to = "/users" className="sidebar__nav-link">
                <i className="bi bi-person"></i> <span>Người dùng</span>
              </Link>
            </li>
            <li className="sidebar__nav-item">
              <a
                className="sidebar__nav-link"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                <i className="bi bi-files"></i> <span>Trang</span>{" "}
                <i className="bi bi-chevron-down"></i>
              </a>

              <ul className="dropdown-menu sidebar__dropdown-menu">
                <li>
                  <a href="#">Thêm Mới phim</a>
                </li>
                <li>
                  <a href="#">Đăng nhập</a>
                </li>
                <li>
                  <a href="#">Đăng ký</a>
                </li>
                <li>
                  <a href="#">404 Page</a>
                </li>
              </ul>
            </li>

            <li className="sidebar__nav-item">
              <a href="#" className="sidebar__nav-link">
                <i className="bi bi-arrow-left"></i>{" "}
                <span>Back to HotFlix</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <Outlet />
    </>
  );
}

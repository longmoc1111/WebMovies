import { Link } from "react-router-dom";
import axiosClient from "@axios/axios-client";
import styles from "./Sidebar.module.scss"
import { useStateContext } from "../../../contexts/ContextProvider";

export default function Sidebar({active}) {
  const { user, setUser, setToken } = useStateContext();
  const onLogout = (ev) => {
    ev.preventDefault();

    axiosClient.post("/logout").then(() => {
      setUser({});
      setToken(null);
    });
  };

  return (
    <div className={`${styles.sidebar} ${active ? styles.sidebar__active : ""}`}>
      <a href="index.html" className={styles.sidebar__logo}>
        <img src="img/logo.svg" alt="" />
      </a>

      <div className={styles.sidebar__user}>
        <div className="sidebar__user-img">
          <img src="/img/user.svg" alt="" />
        </div>

        <div className={styles.sidebar__user__title}>
          <span>Admin</span>
          <p>{user.name}</p>
        </div>
        <form onSubmit={onLogout} className={styles.sidebar__user__btn}>
          <button className={styles.sidebar__user__btn} type="submit">
            <i className="bi bi-box-arrow-right"></i>
          </button>
        </form>
      </div>

      <div className={styles.sidebar__nav__wrap}>
        <ul className={styles.sidebar__nav}>
          <li className={styles.sidebar__nav__item}>
            <Link to="/DashBoard" className={styles.sidebar__nav__link}>
              <i className="bi bi-grid"></i> <span>Dashboard</span>
            </Link>
          </li>

          <li className={styles.sidebar__nav__item}>
            <Link to="/movies" className={styles.sidebar__nav__link}>
              <i className="bi bi-film"></i> <span>Quản lý phim</span>
            </Link>
          </li>

          <li className={styles.sidebar__nav__item}>
            <Link to="/directors" className={styles.sidebar__nav__link}>
              <i className="bi bi-chat"></i> <span>Đạo diễn</span>
            </Link>
          </li>

          <li className={styles.sidebar__nav__item}>
            <Link to="/actors" className={styles.sidebar__nav__link}>
              <i className="bi bi-chat"></i> <span>diễn viên</span>
            </Link>
          </li>
          <li className={styles.sidebar__nav__item}>
            <Link to="/users" className={styles.sidebar__nav__link}>
              <i className="bi bi-person"></i> <span>Người dùng</span>
            </Link>
          </li>
          {/* <li className={styles.sidebar__nav__item}>
              <a
                className={styles.sidebar__nav__link}
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
            </li> */}

          <li className={styles.sidebar__nav__item}>
            <a href="#" className={styles.sidebar__nav__link}>
              <i className="bi bi-arrow-left"></i> <span>Back to HotFlix</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  );
}

import React, { use, useEffect, useRef } from "react";
import styles from "./Header.module.scss";
// import className from ''

export default function Header({onToggleSidebar, active}) {
  return (
    <header className={styles.header}>
      <div className={styles.header__content}>
        <a href="index.html" className={styles.header__logo}>
          <img src="img/logo.svg" alt="" />
        </a>

        <button className={`${styles.header__btn}  ${active ? styles.header__btn__active : ""} ` } 
        onClick={onToggleSidebar} type="button">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </header>
  );
}

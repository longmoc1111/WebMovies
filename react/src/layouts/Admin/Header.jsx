import React, { use, useEffect } from "react";


export default function Header() {
  useEffect(() => {
    const headerBtn = document.querySelector(".header__btn");
    const headerNav = document.querySelector(".sidebar");

    function toggleHeaderMenu() {
      headerBtn.classList.toggle("header__btn--active");
      headerNav.classList.toggle("sidebar--active");
    }

    if (headerBtn) {
      headerBtn.addEventListener("click", toggleHeaderMenu);
    }

    // Cleanup để tránh nhân đôi khi StrictMode render 2 lần
    return () => {
      if (headerBtn) {
        headerBtn.removeEventListener("click", toggleHeaderMenu);
      }
    };
  }, []);
  return (
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
  );
}

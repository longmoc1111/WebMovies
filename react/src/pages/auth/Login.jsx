import axios from "axios";
import { Link } from "react-router-dom";
import React, { useRef, useState } from "react";
import axiosClient from "../../axios/axios-client";
import { useStateContext } from "../../contexts/ContextProvider";

export default function Login() {
  const emailRef = useRef();
  const passwordRef = useRef();

  const [errors, setErrors] = useState(null);
  const { setUser, setToken } = useStateContext();
  const onSubmit = (ev) => {
    ev.preventDefault();
    const payload = {
      email: emailRef.current.value,
      password: passwordRef.current.value,
    };
    axiosClient
      .post("/login", payload)
      .then(({ data }) => {
        setUser(data.user), setToken(data.token);
      })
      .catch((err) => {
        const response = err.response;
        if (response && response.status === 422) {
          if (response.data.errors) {
            setErrors(response.data.errors);
          } else {
            setErrors({
              email: [response.data.message],
            });
          }
        }
      });
  };

  return (
    <div>
      <div
        className="sign section--bg"
        data-bg="https://hotflix.volkovdesign.com/main/img/bg/section__bg.jpg"
      >
        <div className="container">
          <div className="row">
            <div className="col-12">
              <div className="sign__content">
                <form onSubmit={onSubmit} className="sign__form">
                  <a href="index.html" className="sign__logo">
                    <img src="" alt="" />
                    <h1 style={{ color: "#F9AB00" }}>Đăng nhập</h1>
                  </a>
                  {errors && (
                    <div className="alert alert-warning">
                      {Object.keys(errors).map((key) => (
                        <p style={{ margin: 0 }} key={key}>
                          {errors[key][0]}
                        </p>
                      ))}
                    </div>
                  )}
                  <div className="sign__group">
                    <input
                      ref={emailRef}
                      name="email"
                      type="text"
                      className="sign__input"
                      placeholder="Email"
                    />
                  </div>

                  <div className="sign__group">
                    <input
                      ref={passwordRef}
                      name="password"
                      type="password"
                      className="sign__input"
                      placeholder="Password"
                    />
                  </div>

                  <button className="sign__btn" type="submit">
                    Đăng nhập
                  </button>
                  <span className="sign__text">
                    <a href="#">Quên mật khẩu?</a>
                  </span>

                  <span className="sign__text">
                    chưa có tài khoản? <Link to="/signup">Đăng ký !</Link>
                  </span>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

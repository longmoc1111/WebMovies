import axios from "axios";
import React, { useEffect, useRef, useState } from "react";
import axiosClient from "../../axios-client";
import { Link, useLocation } from "react-router-dom";

export default function Users() {
  const nameRef = useRef();
  const emailRef = useRef();
  const passwordRef = useRef();
  const passwordConfirmationRef = useRef();

  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(false);
  const [errors, setErrors] = useState(null);

  const location = useLocation();
  const hasShowToast = useRef(false);
  const initialized = useRef(false);
  const [meta, setMeta] = useState({});
  const [page, setPage] = useState(1);

  useEffect(() => {
    if (initialized.current == false && window.SlimSelect) {
      new window.SlimSelect({
        select: "#filter__sort",
        settings: {
          placeholderText: "Lọc người dùng",
        },
      });
      initialized.current = true;
    }
  }, []);
  useEffect(() => {
    getUsers();
  }, []);

  const getUsers = (url = `/users?page=${page}`) => {
    setLoading(true);
    axiosClient
      .get(url)
      .then(({ data }) => {
        console.log(data);
        setMeta(data.meta);
        setLoading(false);
        setUsers(data.data);
      })
      .catch((err) => {
        console.log(err.response.data);
        setLoading(false);
      });
  };
  const onDelete = (ev, id) => {
    ev.preventDefault();
    axiosClient.delete(`/users/${id}`).then(() => {
      getUsers();
      iziToast.success({
        message: "Xóa thành công!",
        position: "topRight",
      });
    });
  };

  const onCreate = (ev) => {
    ev.preventDefault();
    const payload = {
      name: nameRef.current.value,
      email: emailRef.current.value,
      password: passwordRef.current.value,
      password_confirmation: passwordConfirmationRef.current.value,
    };

    axiosClient
      .post("/users", payload)
      .then((data) => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modal-user")
        );
        modal.hide();
        getUsers();
        iziToast.success({
          message: "Thêm tài khoản thành công!",
          position: "topRight",
        });
      })
      .catch((err) => {
        const response = err.response;
        if (response && response.status === 422) {
          setErrors(response.data.errors);
        }
      });
  };
  useEffect(() => {
    if (!hasShowToast.current && location.state?.message) {
      hasShowToast.current = true;
      iziToast.success({
        message: location.state.message,
        position: "topRight",
      });
    }
    window.history.replaceState({}, document.title);
  }, []);

  return (
    <main className="main">
      <div className="container-fluid">
        <div className="row">
          <div className="col-12">
            <div className="main__title">
              <h2>diễn viên</h2>

              <div className="main__title-wrap">
                <button
                  type="button"
                  data-bs-toggle="modal"
                  className="main__title-link main__title-link--wrap"
                  data-bs-target="#modal-user"
                >
                  Add user
                </button>
                <form action="#" className="filter__select">
                  <select
                    name="sort"
                    className="filter__select"
                    id="filter__sort"
                    // onChange= {this.form.submit()}
                  >
                    <option value="Tên">Tên tác giả</option>
                    <option value="Ngày sinh">Ngày sinh</option>
                    <option value="Quốc tịch">Quốc tịch</option>
                  </select>
                </form>

                <form action="#" className="main__title-form">
                  <input name="search" type="text" placeholder="Tìm kiếm...." />
                  <button type="submit">
                    <i className="bi bi-search"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>

          <div className="col-12">
            <div className="catalog catalog--1">
              <table className="catalog__table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>HỌ VÀ TÊN</th>
                    <th>email</th>
                    <th>avatar</th>
                    <th></th>
                  </tr>
                </thead>

                {loading && (
                  <tbody>
                    (
                    <tr>
                      <td colSpan={5}>
                        <div
                          id="loading-test-1"
                          style={{ width: "100%" }}
                          className="d-flex flex-column justify-content-center align-items-center"
                        >
                          <div
                            className="spinner-border text-primary mb-3"
                            role="status"
                          ></div>
                          <span className="fw-bold text-primary">
                            Loading...
                          </span>
                        </div>
                      </td>
                    </tr>
                    ){" "}
                  </tbody>
                )}

                <tbody>
                  {!loading &&
                    users.map((u) => (
                      <tr key={u.id}>
                        <td>
                          <div className="catalog__text">{u.id}</div>
                        </td>
                        <td>
                          <div className="catalog__text">{u.name}</div>
                        </td>
                        <td>
                          <div className="catalog__user">
                            <div className="catalog__avatar">
                              <img
                                src="/assets/actorAvatar/{{$actor->ActorAvatar}}"
                                alt=""
                              />
                            </div>
                          </div>
                        </td>
                        <td>
                          <div className="catalog__text">{u.email}</div>
                        </td>
                        <td>
                          <div className="catalog__btns">
                            <Link
                              to={`update/${u.id}`}
                              className="catalog__btn catalog__btn--edit"
                            >
                              <i className="bi bi-pencil-square"></i>
                            </Link>
                            <button
                              type="button"
                              data-bs-toggle="modal"
                              className="catalog__btn catalog__btn--delete"
                              data-bs-target={`#modal-delete_${u.id}`}
                            >
                              <i className="bi bi-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))}
                </tbody>
              </table>
            </div>
            {/* <!-- paginator --> */}

            {!loading && (
              <div className="col-12">
                <div className="main__paginator">
                  {/* <!-- amount --> */}
                  <span className="main__paginator-pages">
                    {meta.current_page} - {meta.to} of {meta.total}
                  </span>
                  {/* <!-- end amount --> */}

                  <ul className="main__paginator-list">
                    {meta?.links?.map((link, index) => {
                      const prev = link.label.includes("Previous");
                      const next = link.label.includes("Next");

                      if (prev) {
                        if (!link.url) return;
                        return (
                          <li key={index}>
                            <button onClick={() => getUsers(link.url)}>
                              <i className="bi bi-chevron-left"></i>
                              <span>Prev</span>
                            </button>
                          </li>
                        );
                      }
                      if (next) {
                        if (!link.url) return;
                        return (
                          <li key={index}>
                            <button onClick={() => getUsers(link.url)}>
                              <span>Next</span>
                              <i className="bi bi-chevron-right"></i>
                            </button>
                          </li>
                        );
                      }
                    })}
                  </ul>

                  <ul className="paginator">
                    {meta?.links?.map((link, index) => {
                      const prev = link.label.includes("Previous");
                      const next = link.label.includes("Next");

                      if (prev) {
                        if (!link.url) return;
                        return (
                          <li
                            key={index}
                            className="paginator__item paginator__item--prev"
                          >
                            <button onClick={() => getUsers(link.url)}>
                              <i className="bi bi-chevron-left"></i>
                            </button>
                          </li>
                        );
                      }

                      if (next) {
                        if (!link.url) return;
                        return (
                          <li
                            key={index}
                            className="paginator__item paginator__item--next"
                          >
                            <button onClick={() => getUsers(link.url)}>
                              <i className="bi bi-chevron-right"></i>
                            </button>
                          </li>
                        );
                      }
                       const pageNumber = Number(link.label);
                     
                      if (
                        pageNumber === 1 ||
                        pageNumber === meta.last_page ||
                        (pageNumber >= meta.current_page - 2 && pageNumber <= meta.current_page + 2)
                      ) {
                        return (
                          <li
                            key={index}
                            className={`paginator__item ${
                              link.active === true
                                ? "paginator__item--active"
                                : ""
                            } `}
                          >
                            <button onClick={() => getUsers(link.url)}>
                              {link.label}
                            </button>
                          </li>
                        );
                      }
                      console.log("pagnb" , pageNumber)
                      console.log("link" , link)

                      if (
                        pageNumber === meta.current_page - 3 ||
                        pageNumber === meta.current_page + 3
                      ) {
                        return (
                          <li className="paginator__item">
                            <span>...</span>
                          </li>
                        );
                      }
                    })}
                  </ul>
                </div>  
              </div>
            )}
            {/* <!-- end paginator --> */}
          </div>
        </div>
      </div>
      {/* modal tao user */}
      <div
        className="modal fade"
        id="modal-user"
        tabIndex="-1"
        aria-labelledby="modal-user"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-dialog-centered">
          <div className="modal-content">
            <div className="modal__content">
              <form onSubmit={onCreate} className="modal__form">
                <h4 className="modal__title">Add User</h4>

                <div className="col-12">
                  <div className="sign__group">
                    <label className="sign__label">Tên người dùng</label>
                    <input
                      ref={nameRef}
                      type="text"
                      name="email0"
                      className="sign__input"
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label" htmlFor="email0">
                        Email
                      </label>
                      <input
                        ref={emailRef}
                        type="text"
                        name="email0"
                        className="sign__input"
                      />
                    </div>
                  </div>

                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label" htmlFor="pass0">
                        Mật khẩu
                      </label>
                      <input
                        ref={passwordRef}
                        type="password"
                        name="pass0"
                        className="sign__input"
                      />
                    </div>
                  </div>
                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label" htmlFor="pass0">
                        Mật khẩu xác nhận
                      </label>
                      <input
                        ref={passwordConfirmationRef}
                        type="password"
                        name="pass0"
                        className="sign__input"
                      />
                    </div>
                  </div>
                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label" htmlFor="rights">
                        Quyền
                      </label>
                      <select className="sign__select" id="rights">
                        <option value="User">User</option>
                        <option value="Moderator">Moderator</option>
                        <option value="Admin">Admin</option>
                      </select>
                    </div>
                  </div>

                  <div className="col-12 col-lg-6 offset-lg-3">
                    <button
                      type="submit"
                      className="sign__btn sign__btn--modal"
                    >
                      Add
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {/* end modal tạo user */}
      {users.map((u) => (
        <div
          key={u.id}
          className="modal fade"
          id={`modal-delete_${u.id}`}
          tabIndex="-1"
          aria-labelledby="modal-delete"
          aria-hidden="true"
        >
          <div className="modal-dialog modal-dialog-centered">
            <div className="modal-content">
              <div className="modal__content">
                <form
                  onSubmit={(ev) => onDelete(ev, u.id)}
                  className="modal__form"
                >
                  <h4 className="modal__title">Xoá người dùng</h4>

                  <p className="modal__text">
                    Bạn có chắc muốn xóa tài khoản này ?
                  </p>

                  <div className="modal__btns">
                    <button
                      className="modal__btn modal__btn--apply"
                      type="submit"
                      data-bs-dismiss="modal"
                    >
                      <span>Xóa</span>
                    </button>

                    <button
                      className="modal__btn modal__btn--dismiss"
                      type="button"
                      data-bs-dismiss="modal"
                    >
                      <span>Quay lại</span>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      ))}
    </main>
  );
}

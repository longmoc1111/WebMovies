import React, { useEffect, useRef, useState } from "react";
import axiosClient from "@axios/axios-client";
import { Link, useLocation } from "react-router-dom";

export default function Moives() {
  const [movies, setMovies] = useState([]);
  const [errors, setErrors] = useState();
  const [loading, setLoading] = useState(false);
  const initialized = useRef(false);
  const location = useLocation();
  const hasShowToast = useRef(false);
  const [page, setPage] = useState(1);
  const [meta, setMeta] = useState({});

  useEffect(() => {
    if (initialized.current == false && window.SlimSelect) {
      new window.SlimSelect({
        select: "#filter__sort",
        setting: {
          placeholderText: "lọc phim",
        },
      });
      initialized.current = true;
    }
  }, []);
  useEffect(() => {
    getMovies();
  }, []);

  const getMovies = (url = `/movies?page=${page}`) => {
    setLoading(true);
    axiosClient
      .get(url)
      .then(({ data }) => {
        console.log(data)
        setMovies(data.data);
        setMeta(data.meta);
        console.log(data);
        setLoading(false);
      })
      .catch((err) => {
        const response = err.response;
        // console.log(response);

        if (response?.status === 422) {
          setErrors(response.data.errors);
        } else if (response) {
          setErrors(response.data);
        }
      });
  };
  console.log("meta", meta);
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

  const onDelete = (ev, id) => {
    ev.preventDefault();
    setLoading(false);
    axiosClient
      .delete(`/movies/${id}`)
      .then(({ data }) => {
        iziToast.success({
          message: data.message,
          position: "topRight",
        });
        getMovies();
        setLoading(true);
      })
      .catch((err) => {
        // console.log(err);
      });
  };
  // console.log(movies);
  return (
    // <!-- main content -->
    <main className="main">
      <div className="container-fluid">
        <div className="row">
          {/* <!-- main title --> */}
          <div className="col-12">
            <div className="main__title">
              <h2>phim</h2>
              <div className="main__title-wrap">
                <Link
                  to="/movies/create"
                  className="main__title-link main__title-link--wrap"
                >
                  Thêm mới
                </Link>
                {errors && (
                  <div className="alert alert-warning">
                    {Object.keys(errors).map((key) => (
                      <p style={{ margin: 0 }} key={key}>
                        {errors[key][0]}
                      </p>
                    ))}
                  </div>
                )}

                <form action="#" className="filter__select" id="filterForm">
                  <select
                    name="option"
                    className="filter__select"
                    id="filter__sort"
                  >
                    <option value="Tên phim">Tên phim</option>
                    <option value="Năm ra mắt">Năm ra mắt</option>
                    <option value="Đánh giá">Đánh giá</option>
                  </select>
                </form>

                {/* <!-- search --> */}
                <form action="#" className="main__title-form">
                  <input name="search" type="text" placeholder="Tìm kiếm...." />
                  <button type="submit">
                    <i className="bi bi-search"></i>
                  </button>
                </form>
                {/* <!-- end search --> */}
              </div>
            </div>
          </div>
          {/* <!-- end main title --> */}

          {/* <!-- items --> */}
          <div className="col-12">
            <div className="catalog catalog--1">
              <table className="catalog__table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tên Phim</th>
                    <th>RATING</th>
                    <th>THỂ LOẠI</th>
                    <th>QUỐC GIA</th>
                    <th>NĂM RA MẮT</th>
                    <th>TRẠNG THÁI</th>
                    <th></th>
                  </tr>
                </thead>
                {loading && (
                  <tbody>
                    (
                    <tr>
                      <td colSpan={8}>
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

                {!loading && (
                  <tbody>
                    {movies.map((m, index) => (
                      <tr key={m.id}>
                        <td>
                          <div className="catalog__text">{index + 1}</div>
                        </td>
                        <td>
                          <div className="catalog__text">{m.MovieName}</div>
                        </td>
                        <td>
                          <div className="catalog__text">
                            <i
                              className="bi bi-star"
                              style={{ marginRight: "5px", color: "#f9ab00" }}
                            ></i>
                            {m.MovieEvaluate}
                          </div>
                        </td>
                        <td>
                          <div className="catalog__text">
                            {m.Genres && m.Genres.length
                              ? m.Genres.join(", ")
                              : "Đang cập nhật"}
                          </div>
                        </td>
                        <td>
                          <div className="catalog__text">
                            {m.Countries && m.Countries.length
                              ? m.Countries.join(", ")
                              : "Đang cập nhật"}
                          </div>
                        </td>
                        <td>
                          <div className="catalog__text">{m.MovieYear}</div>
                        </td>
                        <td>
                          <div className="catalog__text catalog__text--green">
                            {m.MovieStatus}
                          </div>
                        </td>
                        <td>
                          <div className="catalog__btns">
                            <a
                              href="#"
                              className="catalog__btn catalog__btn--view"
                            >
                              <i className="bi bi-eye"></i>
                            </a>
                            <Link
                              to={`update/${m.MovieID}`}
                              className="catalog__btn catalog__btn--edit"
                            >
                              <i className="bi bi-pencil-square"></i>
                            </Link>
                            <button
                              type="button"
                              data-bs-toggle="modal"
                              className="catalog__btn catalog__btn--delete"
                              data-bs-target={`#modal-delete_${m.MovieID}`}
                            >
                              <i className="bi bi-trash"></i>
                            </button>
                          </div>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                )}
              </table>
            </div>
          </div>
          {/* <!-- end items --> */}
          {/* <!-- paginator --> */}
          {!loading && (
            <div className="col-12">
              <div className="main__paginator">
                {/* <!-- amount --> */}
                <span className="main__paginator-pages">
                  {meta.from} - {meta.to} of {meta.last_page}
                </span>
                {/* <!-- end amount --> */}

                <ul className="main__paginator-list">
                  {meta?.links?.map((link, index) => {
                    const prev = link.label.includes("Previous");
                    const next = link.label.includes("Next");

                    if (prev) {
                      if(!link.url) return 
                      return (
                        <li key={index}>
                          <button
                            href="#"
                            onClick={() => {
                              getMovies(link.url);
                            }}
                          >
                            <i className="bi bi-chevron-left"></i>
                            <span>Prev</span>
                          </button>
                        </li>
                      );
                    }
                    if (next) {
                      if(!link.url) return
                      return (
                        <li>
                          <button 
                          onClick={() => {
                            getMovies(link.url)
                          }}
                          >
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
                    const isPrev = link.label.includes("Previous");
                    const isNext = link.label.includes("Next");

                    if (isPrev) {
                      if (!link.url) return;
                      return (
                        <li
                          key={index}
                          className="paginator__item paginator__item--prev"
                        >
                          <button onClick={() => getMovies(link.url)}>
                            <i className="bi bi-chevron-left"></i>
                          </button>
                        </li>
                      );
                    }
                    if (isNext) {
                      if (!link.url) return;
                      return (
                        <li
                          key={index}
                          className="paginator__item paginator__item--next"
                        >
                          <button onClick={() => getMovies(link.url)}>
                            <i className="bi bi-chevron-right"></i>
                          </button>
                        </li>
                      );
                    }
                    return (
                      <li
                        key={index}
                        className={`paginator__item ${
                          link.active ? "paginator__item--active" : ""
                        }`}
                      >
                        <button onClick={() => link.url && getMovies(link.url)}>
                          {link.label}
                        </button>
                      </li>
                    );
                  })}
                </ul>
              </div>
            </div>
          )}
          {/* <!-- end paginator -->   */}
        </div>
      </div>
      {movies.map((m) => (
        <div
          key={m.MovieID}
          className="modal fade"
          id={`modal-delete_${m.MovieID}`}
          tabIndex="-1"
          aria-labelledby="modal-delete"
          aria-hidden="true"
        >
          <div className="modal-dialog modal-dialog-centered">
            <div className="modal-content">
              <div className="modal__content">
                <form
                  onSubmit={(ev) => onDelete(ev, m.MovieID)}
                  className="modal__form"
                >
                  <h4 className="modal__title">Xoá người dùng</h4>

                  <p className="modal__text">
                    Bạn có chắc muốn xóa bộ phim này ?
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

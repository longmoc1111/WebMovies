import axios from "axios";
import React, { useEffect, useRef, useState } from "react";
import axiosClient from "../../axios-client";
import { Link, useLocation } from "react-router-dom";

export default function Moives() {
  const [movies, setMovies] = useState([]);
  const [errors, setErrors] = useState();
  const [loading, setLoading] = useState(false);
  const initialized = useRef(false);
  const location = useLocation();
  const hasShowToast = useRef(false);

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

  const getMovies = () => {
    setLoading(true);
    axiosClient
      .get("/movies")
      .then(({ data }) => {
        setMovies(data.data);
        setLoading(false);
      })
      .catch((err) => {
        const response = err.response;
        console.log(response);

        if (response?.status === 422) {
          setErrors(response.data.errors);
        } else if (response) {
          setErrors(response.data);
        }
      });
  };
  useEffect(() => {
    if (!hasShowToast.current && location.state?.message) {
      hasShowToast.current = true;
      iziToast.success({
        message: location.state.message,
        possition: "topRight",
      });
    }
    window.history.replaceState({}, document.title);
  }, []);
  console.log(axiosClient.defaults.baseURL);
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
                            {/* {m.Genres.GenreName} */}
                          </div>
                        </td>
                        <td>
                          <div className="catalog__text">
                            {m.Countries && m.Countries.length
                              ? m.Countries.map((c) => c.CountryName).join(", ")
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
                              data-bs-target="#{{$movie->MovieID}}"
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
        </div>
      </div>
    </main>
  );
}

import React, { useEffect, useState } from "react";
import { customStyles } from "../../../../public/js/selectReact";
import Select from "react-select";
import axios from "axios";
import axiosClient from "../../axios-client";
import { useParams } from "react-router-dom";

export default function Update() {
  const [loading, setLoading] = useState(false);
  const { id } = useParams();
  const [directors, setDirectors] = useState([]);
  const [actors, setActors] = useState([]);
  const [types, setTypes] = useState([]);
  const [genres, SetGenres] = useState([]);
  const [countries, setCountries] = useState([]);
  const [formData, setFormData] = useState({
    MovieName: "",
    MovieDescription: "",
    MovieStatus: "",
    MovieEvaluate: "",
    MovieLink: "",
    MovieYear: "",
    GenreID: "",
    ActorID: [],
    DirectorID: [],
    CountryID: [],
    TypeID: [],
    MovieImage: null,
  });
  const StatusOption = [
    { value: "Full HD", label: "Full HD" },
    { value: "Bản cam", label: "Bản cam" },
    { value: "Sắp ra mắt", label: "Sắp ra mắt" },
  ];

  useEffect(() => {
    setLoading(true);
    axiosClient
      .get(`/movies/${id}`)
      .then(({ data }) => {
        console.log(data);

        setDirectors(
          data.directors.map((d) => ({
            value: d.DirectorID,
            label: d.DirectorName,
          }))
        );
        setActors(
          data.actors.map((a) => ({
            value: a.ActorID,
            label: a.ActorName,
          }))
        );
        SetGenres(
          data.genres.map((g) => ({
            value: g.GenreID,
            label: g.GenreName,
          }))
        );
        setTypes(
          data.types.map((t) => ({
            value: t.TypeID,
            label: t.TypeName,
          }))
        );
        setCountries(
          data.countries.map((c) => ({
            value: c.CountryID,
            label: c.CountryName,
          }))
        );
        setFormData(data.movies);
        setLoading(false);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  const onUpdate = (ev) => {
    ev.preventDefault();
    const fd = new FormData();
    fd.append("MovieName", formData.MovieName);
    fd.append("MovieDescription", formData.MovieDescription);
    fd.append("MovieStatus", formData.MovieStatus);
    fd.append("MovieEvaluate", formData.MovieEvaluate);
    fd.append("MovieLink", formData.MovieLink);
    fd.append("MovieYear", formData.MovieYear);
    fd.append("GenreID", formData.GenreID);
    formData.ActorID.forEach((id) => fd.append("ActorID[]", id));
    formData.DirectorID.forEach((id) => fd.append("DirectorID[]", id));
    formData.CountryID.forEach((id) => fd.append("CountryID[]", id));
    formData.TypeID.forEach((id) => fd.append("TypeID[]", id));

    fd.append("MovieImage", formData.MovieImage);
   
    axiosClient
      .put(`/movies/${formData.MovieID}`, fd)
      .then((data) => {
        console.log(data);
      })
      .catch((err) => {
        console.log(err);
      });
  };

  console.log(directors);

  console.log("fm dáta",formData);

  return (
    <main className="main">
      <div className="container-fluid">
        <div className="row">
          {/* <!-- main title --> */}
          <div className="col-12">
            <div className="main__title">
              <h2>THÊM PHIM MỚI</h2>
            </div>
          </div>
          {/* {errors && (
            <div className="alert alert-warning">
              {Object.keys(errors).map((key) => (
                <p style={{ margin: 0 }} key={key}>
                  {errors[key][0]}
                </p>
              ))}
            </div>
          )} */}
          {loading && (
            <div
              id="loading-test-1"
              style={{ width: "100%", height: "80vh" }}
              className="d-flex flex-column justify-content-center align-items-center "
            >
              <div
                className="spinner-border text-primary mb-3"
                role="status"
              ></div>
              <span className="fw-bold text-primary">Loading...</span>
            </div>
          )}

          {!loading && (
            <div className="col-12">
              <form
                onSubmit={onUpdate}
                method="POST"
                className="sign__form sign__form--add"
                encType="multipart/form-data"
              >
                <div className="row">
                  <div className="col-12 col-xl-7">
                    <div className="row">
                      <div className="col-12">
                        <div className="sign__group">
                          <input
                            name="MovieName"
                            type="text"
                            className="sign__input"
                            required
                            placeholder="Tên phim"
                            value={formData.MovieName}
                            onChange={(e) =>
                              setFormData({
                                ...formData,
                                MovieName: e.target.value,
                              })
                            }
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <textarea
                            name="MovieDescription"
                            id="text"
                            className="sign__textarea"
                            placeholder="Mô tả"
                            value={formData.MovieDescription}
                            onChange={(e) =>
                              setFormData({
                                ...formData,
                                MovieDescription: e.target.value,
                              })
                            }
                          ></textarea>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="collapse show multi-collapse">
                          <div className="sign__video position-relative">
                            <label
                              id="movie1"
                              htmlFor="sign__video-upload"
                              className="position-relative d-inline-flex align-items-center justify-content-between w-100"
                              style={{ height: "46px", paddingRight: "30px" }}
                            >
                              Ảnh nền phim
                              <i
                                className="bi bi-image"
                                style={{ fontSize: "20px" }}
                              ></i>
                            </label>
                            <input
                              data-name="#movie1"
                              id="sign__video-upload"
                              name="MovieImage"
                              className="sign__video-upload"
                              type="file"
                              onChange={(e) =>
                                setFormData({
                                  ...formData,
                                  MovieImage: e.target.files[0],
                                })
                              }
                            />
                          </div>
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <input
                            name="MovieYear"
                            type="date"
                            className="sign__input"
                            value={formData.MovieYear}
                            onChange={(e) =>
                              setFormData({
                                ...formData,
                                MovieYear: e.target.value,
                              })
                            }
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-12 col-xl-5">
                    <div className="row">
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <Select
                            options={StatusOption}
                            value={StatusOption.find(
                              (opt) => opt.value === formData.MovieStatus
                            )}
                            onChange={(selected) => {
                              setFormData((prev) => ({
                                ...prev,
                                MovieStatus: selected.value,
                              }));
                            }}
                            placeholder={"Trạng thái"}
                            styles={customStyles}
                          />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <input
                            name="MovieEvaluate"
                            className="sign__input"
                            required
                            type="number"
                            min="1.0"
                            max="10.0"
                            step="0.1"
                            placeholder="đánh giá"
                            value={formData.MovieEvaluate}
                            onChange={(e) =>
                              setFormData({
                                ...formData,
                                MovieEvaluate: e.target.value,
                              })
                            }
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={genres}
                            value={genres.find(
                              (opt) => opt.value === formData.GenreID
                            )}
                            onChange={(selected) =>
                              setFormData((prev) => ({
                                ...prev,
                                GenreID: selected.value,
                              }))
                            }
                            styles={customStyles}
                            placeholder="Loại phim"
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={types}
                            value={types.filter((opt) =>
                              formData.TypeID.includes(opt.value)
                            )}
                            onChange={(selected) =>
                              setFormData((prev) => ({
                                ...prev,
                                TypeID: selected
                                  ? selected.map((item) => item.value)
                                  : [],
                              }))
                            }
                            placeholder={"Thể loại"}
                            styles={customStyles}
                            isMulti
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={countries}
                            value={countries.filter((opt) =>
                              formData.CountryID.includes(opt.value)
                            )}
                            onChange={(selected) =>
                              setFormData((prev) => ({
                                ...prev,
                                CountryID: selected
                                  ? selected.map((item) => item.value)
                                  : [],
                              }))
                            }
                            placeholder={"Quốc gia"}
                            styles={customStyles}
                            isMulti
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-12 col-md-6 col-xl-4">
                    <div className="sign__group">
                      <Select
                        options={directors}
                        value={directors.filter((opt) =>
                          formData.DirectorID.includes(opt.value)
                        )}
                        onChange={(selected) =>
                          setFormData((prev) => ({
                            ...prev,
                            DirectorID: selected
                              ? selected.map((item) => item.value)
                              : [],
                          }))
                        }
                        placeholder={"Tác giả"}
                        styles={customStyles}
                        isMulti
                      />
                    </div>
                  </div>
                  <div className="col-12 col-md-6 col-xl-8">
                    <div className="sign__group">
                      <Select
                        options={actors}
                        value={actors.filter((opt) =>
                          formData.ActorID.includes(opt.value)
                        )}
                        onChange={(selected) =>
                          setFormData((prev) => ({
                            ...prev,
                            ActorID: selected
                              ? selected.map((item) => item.value)
                              : [],
                          }))
                        }
                        placeholder={"Diễn viên"}
                        styles={customStyles}
                        isMulti
                      />
                    </div>
                  </div>

                  <div className="col-12">
                    <div className="collapse show multi-collapse">
                      <input
                        name="MovieLink"
                        type="url"
                        className="sign__input"
                        required
                        placeholder="Link phim"
                        value={formData.MovieLink}
                        onChange={(e) =>
                          setFormData({
                            ...formData,
                            MovieLink: e.target.value,
                          })
                        }
                      />
                    </div>
                  </div>
                </div>
                <div className="col-12">
                  <button type="submit" className="sign__btn sign__btn--small">
                    thêm
                  </button>
                </div>
                {/* </div> */}
              </form>
            </div>
          )}
          {/* <!-- end form --> */}
        </div>
      </div>
    </main>
  );
}

import React, { useEffect, useRef, useState } from "react";
import axiosClient from "../../axios-client";
import Select from "react-select";
import { customStyles } from "../../../../public/js/selectReact";
import { useNavigate } from "react-router-dom";
export default function Create() {
  const initialized = useRef(false);
  const [actors, setActors] = useState([]);
  const [genres, setGenres] = useState([]);
  const [directors, setDirectors] = useState([]);
  const [countries, setCountries] = useState([]);
  const [types, setTypes] = useState([]);
  const [loading, setLoading] = useState(false);
  const [errors, setErrors] = useState(null);
  const navigate = useNavigate()
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

  useEffect(() => {
    setLoading(true);
    axiosClient
      .get("/movies/create-data")
      .then(({ data }) => {
        setActors(data.actors);
        setDirectors(data.directors);
        setGenres(data.genres);
        setCountries(data.countries);
        setTypes(data.types);
        console.log(data);
        setLoading(false);
      })
      .catch((err) => {
        setLoading(false);
      });
  }, []);
  const GenreOptions = genres.map((g) => ({
    value: g.GenreID,
    label: g.GenreName,
  }));
  const statusOptions = [
    { value: "Full HD", label: "Full HD" },
    { value: "Bản cam", label: "Bản cam" },
    { value: "Sắp ra mắt", label: "Sắp ra mắt" },
  ];

  const actorOptions = actors.map((a) => ({
    value: a.ActorID,
    label: a.ActorName,
  }));

  const directorOptions = directors.map((d) => ({
    value: d.DirectorID,
    label: d.DirectorName,
  }));

  const countryOptions = countries.map((c) => ({
    value: c.CountryID,
    label: c.CountryName,
  }));

  const typeOptions = types.map((t) => ({
    value: t.TypeID,
    label: t.TypeName,
  }));

  const onCreate = async (ev) => {
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
    console.log("fd", fd.ActorID);
    // File
    fd.append("MovieImage", formData.MovieImage);

    axiosClient
      .post("/movies", fd)
      .then((data) => {
        navigate('/movies', {
          state: {
            message:"Thêm mới bộ phim thành công!"
          }
        })
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

  // console.log(formData.MovieImage);
  console.log(formData);
  return (
    // <!-- main content -->
    <main className="main">
      <div className="container-fluid">
        <div className="row">
          {/* <!-- main title --> */}
          <div className="col-12">
            <div className="main__title">
              <h2>THÊM PHIM MỚI</h2>
            </div>
          </div>
          {errors && (
            <div className="alert alert-warning">
              {Object.keys(errors).map((key) => (
                <p style={{ margin: 0 }} key={key}>
                  {errors[key][0]}
                </p>
              ))}
            </div>
          )}
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
                onSubmit={onCreate}
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
                            onChange={(prev) =>
                              setFormData({
                                ...formData,
                                MovieYear: prev.target.value,
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
                            options={statusOptions}
                            value={statusOptions.find(
                              (opt) => opt.value === statusOptions.status
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
                            options={GenreOptions}
                            value={GenreOptions.find(
                              (opt) => opt.value === formData.genresID
                            )}
                            onChange={(selected) => {
                              setFormData((prev) => ({
                                ...prev,
                                GenreID: selected.value,
                              }));
                            }}
                            styles={customStyles}
                            placeholder="Loại phim"
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={typeOptions}
                            value={typeOptions.filter((opt) =>
                              formData.TypeID.includes(opt.value)
                            )}
                            placeholder={"Thể loại"}
                            onChange={(selected) => {
                              setFormData((prev) => ({
                                ...prev,
                                TypeID: selected
                                  ? selected.map((item) => item.value)
                                  : [],
                              }));
                            }}
                            styles={customStyles}
                            isMulti
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={countryOptions}
                            value={countryOptions.filter((opt) =>
                              formData.CountryID.includes(opt.value)
                            )}
                            onChange={(selected) => {
                              setFormData((prev) => ({
                                ...prev,
                                CountryID: selected
                                  ? selected.map((item) => item.value)
                                  : [],
                              }));
                            }}
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
                        options={directorOptions}
                        value={directorOptions.filter((opt) =>
                          formData.DirectorID.includes(opt.value)
                        )}
                        onChange={(selected) => {
                          setFormData((prev) => ({
                            ...prev,
                            DirectorID: selected
                              ? selected.map((item) => item.value)
                              : [],
                          }));
                        }}
                        placeholder={"Tác giả"}
                        styles={customStyles}
                        isMulti
                      />
                    </div>
                  </div>
                  <div className="col-12 col-md-6 col-xl-8">
                    <div className="sign__group">
                      <Select
                        options={actorOptions}
                        value={actorOptions.filter((opt) =>
                          formData.ActorID.includes(opt.value)
                        )}
                        onChange={(selected) => {
                          setFormData((prev) => ({
                            ...prev,
                            ActorID: selected
                              ? selected.map((item) => item.value)
                              : [],
                          }));
                        }}
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
                        onChange={(prev) =>
                          setFormData({
                            ...formData,
                            MovieLink: prev.target.value,
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

import React, { useEffect, useState } from "react";
import { customStyles } from "../../../../public/js/selectReact";
import Select from "react-select";
import axios from "axios";
import axiosClient from "../../axios-client";
import { useNavigate, useParams } from "react-router-dom";

export default function Update() {
  const [loading, setLoading] = useState(false);
  const { id } = useParams();
  const [directors, setDirectors] = useState([]);
  const [actors, setActors] = useState([]);
  const [types, setTypes] = useState([]);
  const [genres, SetGenres] = useState([]);
  const [countries, setCountries] = useState([]);
  const [chooseType, setChooseType] = useState("single");
  const [episodes, setEpisodes] = useState();

  const navigate = useNavigate();
  const [errors, setErrors] = useState();

  const createEpisode = (count) => {
    setEpisodes((prev) => {
      const previous = [...prev];
      if (count > previous.length) {
        const extra = Array.from(
          { length: count - previous.length },
          (_, i) => ({
            ID: previous.length + i + 1,
            EpisodeName: "",

            sources: [
              {
                ServerName: "",
                Link_embed: "",
                Link_m3u8: "",
              },
            ],
          })
        );
        return [...previous, ...extra];
      }
      return previous.slice(0, count);
    });
  };

  const [formData, setFormData] = useState({
    MovieName: "",
    MovieDescription: "",
    MovieStatus: "",
    MovieEvaluate: "",
    MovieLink: "",
    MovieYear: "",
    TypeID: "",
    TotalEpisode: "",
    MovieType: "",
    GenreID: [],
    ActorID: [],
    DirectorID: [],
    CountryID: [],

    MovieImage: null,
  });

  const StatusOption = [
    { value: "Full HD", label: "Full HD" },
    { value: "Bản cam", label: "Bản cam" },
    { value: "Sắp ra mắt", label: "Sắp ra mắt" },
  ];

  const QualityOption = [
    { value: "Bản cam", label: "Bản cam" },
    { value: "Full HD", label: "Full HD" },
  ];
  const serverOptions = [
    { value: "Thuyết minh", label: "Thuyết minh" },
    { value: "Vietsub", label: "Vietsub" },
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

        setEpisodes(data.movies.Episodes);

        setFormData(data.movies);

        if (data.movies.MovieType == "single") {
          setChooseType("single");
        } else if (data.movies.MovieType == "series") {
          setChooseType("series");
        }
        setLoading(false);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);

  // console.log(formData)

  const onUpdate = (ev) => {
    ev.preventDefault();
    const fd = new FormData();
    fd.append("MovieName", formData.MovieName);
    fd.append("MovieDescription", formData.MovieDescription);
    fd.append("MovieStatus", formData.MovieStatus);
    fd.append("MovieEvaluate", formData.MovieEvaluate);
    fd.append("MovieLink", formData.MovieLink);
    fd.append("MovieYear", formData.MovieYear);
    fd.append("TypeID", formData.TypeID);
    fd.append("TotalEpisode", formData.TotalEpisode);
    fd.append("MovieType", formData.MovieType)
    formData.ActorID.forEach((id) => fd.append("ActorID[]", id));
    formData.DirectorID.forEach((id) => fd.append("DirectorID[]", id));
    formData.CountryID.forEach((id) => fd.append("CountryID[]", id));
    formData.GenreID.forEach((id) => fd.append("GenreID", id));
    fd.append("Episodes", JSON.stringify(episodes))

    fd.append("_method", "PUT");
    if (formData.MovieImage instanceof File) {
      fd.append("MovieImage", formData.MovieImage);
    }

    axiosClient
      .post(`/movies/${formData.MovieID}`, fd, {
        headers: { "Content-Type": "multipart/form-data" },
      })
      .then(({ data }) => {
        console.log(data)
        // navigate("/movies", {
        //   state: {
        //     message: data.message,
        //   },
        // });
      })
      .catch((err) => {
        const response = err.response;
        if (response && response.status === 422) {
          if (response.data.errors) {
            setErrors(response.data.errors);
          }
        }
      });
  };

  console.log(episodes);

  // console.log("fm dáta", formData);

  return (
    <main className="main">
      <div className="container-fluid">
        <div className="row">
          {/* <!-- main title --> */}
          <div className="col-12">
            <div className="main__title">
              <h2>SỬA THÔNG TIN PHIM</h2>
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
                onSubmit={onUpdate}
                method="POST"
                className="sign__form sign__form--add"
                encType="multipart/form-data"
              >
                <div className="row mb-4">
                  <div className="col-12 col-xl-7">
                    <div className="row">
                      <div className="col-12">
                        <div className="sign__group">
                          <input
                            name="MovieName"
                            type="text"
                            className="sign__input "
                            required
                            title="Tên phim"
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
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <input
                            className="sign__input"
                            value={formData.TotalEpisode}
                            onChange={(e) => {
                              setFormData((prev) => ({
                                ...prev,
                                TotalEpisode: e.target.value,
                              }));
                            }}
                            placeholder={"Tổng số tập"}
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
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <Select
                            options={QualityOption}
                            value={QualityOption.find(
                              (opt) => opt.value === formData.MovieQuality
                            )}
                            onChange={(selected) => {
                              setFormData((prev) => ({
                                ...prev,
                                MovieQuality: selected.value,
                              }));
                            }}
                            placeholder={"Chất lượng"}
                            styles={customStyles}
                          />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <Select
                            options={types}
                            value={types.find(
                              (opt) => formData.TypeID === opt.value
                            )}
                            onChange={(selected) =>
                              setFormData((prev) => ({
                                ...prev,
                                TypeID: selected ? selected.value : "",
                              }))
                            }
                            placeholder={"Thể loại"}
                            styles={customStyles}
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={genres}
                            value={genres.filter((opt) =>
                              formData.GenreID.includes(opt.value)
                            )}
                            onChange={(selected) =>
                              setFormData((prev) => ({
                                ...prev,
                                GenreID: selected
                                  ? selected.map((item) => item.value)
                                  : [],
                              }))
                            }
                            styles={customStyles}
                            placeholder="Loại phim"
                            title="Loại phim"
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
                            title="Quốc gia"
                            isMulti
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-12 col-md-6  ">
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
                  <div className="col-12 col-md-6 ">
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
                    <div className="sign__group">
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

                  <div className="col-12">
                    <div className="collapse show">
                      <div className="sign__video">
                        <label
                          id="movie1"
                          htmlFor="sign__video-upload"
                          className=" d-inline-flex align-items-center justify-content-between w-100"
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
                  <div className="col-12">
                    <div className="sign__group justify-content-center d-flex">
                      <div className="sign__season">
                        <img
                          src={`${
                            import.meta.env.VITE_API_BASE_URL
                          }/storage/upload/image/${formData.MovieImage}`}
                          alt=""
                        />
                      </div>
                    </div>
                  </div>

                  <div className="col-12 mt-3">
                    <div className="sign__group">
                      <ul className="sign__radio">
                        <li>
                          <input
                            id="type1"
                            type="radio"
                            name="type"
                            value={"single"}
                            checked={chooseType == "single"}
                            onChange={() => {
                              setChooseType("single");
                              setEpisodes([
                                {
                                  EpisodeName: 0,
                                  sources: [
                                    {
                                      ServerName: "",
                                      Link_embed: "",
                                      Link_m3u8: "",
                                    },
                                  ],
                                },
                              ]);
                            }}
                          />
                          <label htmlFor="type1">Phim lẻ</label>
                        </li>
                        <li>
                          <input
                            id="type2"
                            type="radio"
                            name="type"
                            value={"series"}
                            checked={chooseType == "series"}
                            onChange={() => {
                              setChooseType("series");
                              setEpisodes([]);
                            }}
                          />
                          <label htmlFor="type2">Phim bộ</label>
                        </li>
                      </ul>
                    </div>
                  </div>
                  {chooseType == "single" && (
                    <div className="col-12">
                      <div>
                        <div className="row">
                          <div className="sign__season">
                            <div className="col-12 col-md-6">
                              <div className="sign__group">
                                <input
                                  type="text"
                                  className="sign__input"
                                  placeholder="Tập phim"
                                  value={"Full"}
                                  readOnly
                                />
                              </div>
                            </div>
                          </div>
                          <div className="col-12 d-flex align-items-center mb-3">
                            <span className="sign__episode-title">
                              Nguồn phim
                            </span>
                            <button
                              onClick={() => addSource(0)}
                              className="sign__add btn"
                              type="button"
                            >
                              <i className="bi bi-plus"></i>
                            </button>
                          </div>

                          {episodes?.[0]?.sources?.map((src, srcIndex) => (
                          <div className="sign__season">
                            {srcIndex >= 1 && (
                            <div className="col-12">
                              <button
                                // onClick={() => removeSource(0, srcIndex)}
                                className="sign__delete btn"
                                style={{ marginRight: "20px" }}
                                type="button"
                              >
                                <i className="bi bi-x"></i>
                              </button>
                            </div>
                              )}   
                            <div className="col-6 col-md-6">
                              <div className="sign__group">
                                <Select
                                  options={serverOptions}
                                  value={serverOptions.find(
                                    (opt) => opt.value === src.ServerName
                                  )}
                                  onChange={(selected) => {
                                    setEpisodes((prev) => {
                                      const copy = [...prev];
                                      copy[0].sources[srcIndex].ServerName =
                                        selected.value;
                                      return copy;
                                    });
                                  }}
                                  placeholder={"Server"}
                                  styles={customStyles}
                                  required
                                />
                              </div>
                            </div>

                            <div className="col-12  ">
                              <div className="sign__group">
                                <input
                                  type="url"
                                  className="sign__input"
                                  placeholder="Link_embed"
                                  required
                                  value={src.Link_embed}
                                  onChange={(e) => {
                                    setEpisodes((prev) => {
                                      const copy = [...prev];
                                      copy[0].sources[srcIndex].Link_embed =
                                        e.target.value;
                                      return copy;
                                    });
                                  }}
                                />
                              </div>
                            </div>

                            <div className="col-12  ">
                              <div className="sign__group">
                                <input
                                  type="url"
                                  className="sign__input"
                                  placeholder="Link_m3u8"
                                  required
                                  value={src.Link_m3u8}
                                  onChange={(e) => {
                                    setEpisodes((prev) => {
                                      const copy = [...prev];
                                      copy[0].sources[srcIndex].Link_m3u8 =
                                        e.target.value;
                                      return copy;
                                    });
                                  }}
                                />
                              </div>
                            </div>
                          </div>
                            ))}  
                        </div>
                      </div>
                    </div>
                  )}

                  {chooseType == "series" && (
                    <div className="col-12">
                      <div>
                        <div className="sign__season">
                          <div className="col-12">
                            <div className="sign__group">
                              <input
                                type="number"
                                className="sign__input"
                                placeholder="Số tập"
                                required
                                value={
                                  formData.Episodes
                                    ? formData.Episodes.length
                                    : null
                                }
                                onChange={(e) => createEpisode(e.target.value)}
                              />
                            </div>
                          </div>
                        </div>
                        <div className="row">
                          {episodes.map((ep, index) => (
                            <div className="sign__season">
                              <div className="col-12 col-md-6">
                                <div className="sign__group">
                                  <input
                                    type="text"
                                    className="sign__input"
                                    placeholder="Tập phim"
                                    value={ep.EpisodeName}
                                  />
                                </div>
                              </div>

                              <div className="col-12 d-flex align-items-center mb-3">
                                <span className="sign__episode-title">
                                  Nguồn phim
                                </span>
                                <button
                                  onClick={() => addSource(0)}
                                  className="sign__add btn"
                                  type="button"
                                >
                                  <i className="bi bi-plus"></i>
                                </button>
                              </div>

                              {episodes[index].sources.map((src, srcIndex) => (
                                <div className="sign__season">
                                  {srcIndex >= 1 && (
                                    <div className="col-12">
                                      <button
                                        // onClick={() => removeSource(0, srcIndex)}
                                        className="sign__delete btn"
                                        style={{ marginRight: "20px" }}
                                        type="button"
                                      >
                                        <i className="bi bi-x"></i>
                                      </button>
                                    </div>
                                  )}
                                  <div className="col-6 col-md-6">
                                    <div className="sign__group">
                                      <Select
                                        options={serverOptions}
                                        value={serverOptions.find(
                                          (opt) => opt.value === src.ServerName
                                        )}
                                        onChange={(selected) => {
                                          setEpisodes((prev) => {
                                            const copy = [...prev];
                                            copy[0].sources[
                                              srcIndex
                                            ].ServerName = selected.value;
                                            return copy;
                                          });
                                        }}
                                        placeholder={"Server"}
                                        styles={customStyles}
                                        required
                                      />
                                    </div>
                                  </div>

                                  <div className="col-12  ">
                                    <div className="sign__group">
                                      <input
                                        type="url"
                                        className="sign__input"
                                        placeholder="Link_embed"
                                        required
                                        value={src.Link_embed}
                                        onChange={(e) => {
                                          setEpisodes((prev) => {
                                            const copy = [...prev];
                                            copy[0].sources[srcIndex].Link_embed =
                                              e.target.value;
                                            return copy;
                                          });
                                        }}
                                      />
                                    </div>
                                  </div>

                                  <div className="col-12  ">
                                    <div className="sign__group">
                                      <input
                                        type="url"
                                        className="sign__input"
                                        placeholder="Link_m3u8"
                                        required
                                        value={src.Link_m3u8}
                                        onChange={(e) => {
                                          setEpisodes((prev) => {
                                            const copy = [...prev];
                                            copy[0].sources[srcIndex].Link_m3u8 =
                                              e.target.value;
                                            return copy;
                                          });
                                        }}
                                      />
                                    </div>
                                  </div>
                                </div>
                              ))}
                            </div>
                          ))}
                          {/* ))} */}
                        </div>
                      </div>
                    </div>
                  )}
                </div>
                <div className="col-12">
                  <button type="submit" className="sign__btn sign__btn--small">
                    Lưu
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

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
  const [chooseType, setChooseType] = useState("single");
  const [episodes, setEpisodes] = useState([
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
  const navigate = useNavigate();

  const createEpisode = (count) => {
    setEpisodes((prev) => {
      const previous = [...prev];
      //neu so luong tap lon hon hien tai
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
  const setTypeMovie = (GenreValue) => {
    if (GenreValue == "single") {
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
    } else if (GenreValue == "series") {
      setChooseType("series");
      
      setEpisodes([]);
    }
  };
  const addSource = (episodeIndex) => {
    const copy = [...episodes];
    copy[episodeIndex].sources.push({
      ServerName: "",
      Link_embed: "",
      Link_m3u8: "",
    });
    setEpisodes(copy);
  };
  const removeEpisode = (index) => {
    setEpisodes((prev) => prev.filter((_, i) => i !== index));
  };
  const removeSource = (index, srcIndex) => {
    const copy = [...episodes];
    copy[index].sources.splice(srcIndex, 1);
    setEpisodes(copy);
  };
  console.log(episodes);
  const [formData, setFormData] = useState({
    MovieName: "",
    MovieDescription: "",
    MovieStatus: "",
    MovieEvaluate: "",
    MovieLink: "",
    MovieYear: "",
    TypeID: "",
    MovieType: "single",
    MovieQuality: "",
    TotalEpisode: "",
    ActorID: [],
    DirectorID: [],
    CountryID: [],
    GenreID: [],
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
        // console.log(data);
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
    { value: "Sắp ra mắt", label: "Sắp ra mắt" },
    { value: "Đã hoàn thành", label: "Đã hoàn thành" },
  ];
  const QualityOption = [
    { value: "Bản cam", label: "Bản cam" },
    { value: "Full HD", label: "Full HD" },
  ];
  const serverOptions = [
    { value: "Thuyết minh", label: "Thuyết minh" },
    { value: "Vietsub", label: "Vietsub" },
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
    fd.append("TypeID", formData.TypeID);
    fd.append("MovieQuality", formData.MovieQuality);
    fd.append("TotalEpisode", formData.TotalEpisode);
    fd.append("MovieType",formData.MovieType);
    formData.ActorID.forEach((id) => fd.append("ActorID[]", id));
    formData.DirectorID.forEach((id) => fd.append("DirectorID[]", id));
    formData.CountryID.forEach((id) => fd.append("CountryID[]", id));
    formData.GenreID.forEach((id) => fd.append("GenreID[]", id));
    fd.append("Episodes", JSON.stringify(episodes));
    // File
    fd.append("MovieImage", formData.MovieImage);

    axiosClient
      .post("/movies", fd)
      .then((data) => {
        navigate("/movies", {
          state: {
            message: "Thêm mới bộ phim thành công!",
          },
        });
        // console.log(data)
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
  console.log("episo", episodes);
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
                            required
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
                            required
                            onChange={(prev) =>
                              setFormData({
                                ...formData,
                                MovieYear: prev.target.value,
                              })
                            }
                          />
                        </div>
                      </div>
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
                            required
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-12 col-xl-5">
                    <div className="row">
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <input
                            name="MovieYear"
                            type="text"
                            className="sign__input"
                            placeholder="Tổng số tập"
                            required
                            onChange={(prev) =>
                              setFormData({
                                ...formData,
                                TotalEpisode: prev.target.value,
                              })
                            }
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
                            styles={customStyles}
                            placeholder="Chất lượng"
                            required
                          />
                        </div>
                      </div>
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <Select
                            options={typeOptions}
                            value={typeOptions.find(
                              (opt) => formData.TypeID == opt.value
                            )}
                            placeholder={"Loại phim"}
                            onChange={(selected) => {
                              setFormData((prev) => ({
                                ...prev,
                                TypeID: selected ? selected.value : "",
                              }));
                            }}
                            styles={customStyles}
                            required
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <Select
                            options={GenreOptions}
                            value={GenreOptions.find(
                              (opt) => opt.value === formData.GenreID
                            )}
                            onChange={(selected) => {
                                setFormData((prev) => ({
                                  ...prev, GenreID: selected ? selected.map((item) => item.value) : []
                                }))

                              // if (selected.value == 1) {
                              //   setGenreMovie("phimle");
                              // } else if (selected.value == 2) {
                              //   setGenreMovie("phimbo");
                              // }
                            }}
                            placeholder={"Thể loại"}
                            styles={customStyles}
                            required
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
                            required
                            isMulti
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="col-12 col-md-6 col-xl-6">
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
                        required
                        isMulti
                      />
                    </div>
                  </div>
                  <div className="col-12 col-md-6 col-xl-6">
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
                        required
                        isMulti
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
                    <div className="collapse show multi-collapse">
                      <input
                        name="MovieLink"
                        type="url"
                        className="sign__input"
                        required
                        placeholder="Trailer"
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
                          onChange={() => {setTypeMovie("single")
                            setFormData((prev) => ({
                              ...prev, MovieType: "single"
                            }))
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
                            onChange={() => {setTypeMovie("series")
                                setFormData((prev) => ({
                                 ...prev, MovieType: "series"
                              }))
                            }
                            
                          }
                        />
                        <label htmlFor="type2">Phim bộ</label>
                      </li>
                    </ul>
                  </div>
                </div>

                {/* <!-- phim lẻ --> */}
                {chooseType === "single" && (
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

                        {episodes[0].sources.map((src, srcIndex) => (
                          <div className="sign__season">
                            {srcIndex >= 1 && (
                              <div className="col-12">
                                <button
                                  onClick={() => removeSource(0, srcIndex)}
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
                                  // required
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
                                  // required
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
                {/* <!-- end movie --> */}

                {/* <!-- phim bộ--> */}
                {chooseType === "series" && (
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
                              onChange={(e) => createEpisode(e.target.value)}
                            />
                          </div>
                        </div>
                      </div>
                      {/* <!-- season --> */}
                      {episodes.map((ep, index) => (
                        <div className="sign__season">
                          {/* <!-- episode --> */}
                          <div className="sign__episode">
                            <div className="row">
                              <div className="col-12 col-md-6">
                                <div className="sign__group">
                                  <input
                                    type="number"
                                    className="sign__input"
                                    placeholder="Tập phim"
                                    required
                                    value={ep.EpisodeName}
                                    onChange={(e) => {
                                      const copy = [...episodes];
                                      copy[index].EpisodeName = e.target.value;
                                      setEpisodes(copy);
                                    }}
                                  />
                                </div>
                              </div>
                              <div className="col-12 d-flex align-items-center mb-3">
                                <span className="sign__episode-title">
                                  Nguồn phim
                                </span>
                                <button
                                  onClick={() => addSource(index)}
                                  className="sign__add btn"
                                  type="button"
                                >
                                  <i className="bi bi-plus"></i>
                                </button>
                              </div>
                              {ep.sources.map((src, srcIndex) => (
                                <div className="sign__season">
                                  {srcIndex >= 1 && (
                                    <div className="col-12">
                                      <button
                                        onClick={() =>
                                          removeSource(index, srcIndex)
                                        }
                                        className="sign__delete btn"
                                        type="button"
                                      >
                                        <i className="bi bi-x"></i>
                                      </button>
                                    </div>
                                  )}
                                  <div className="col-6 col-md-6">
                                    <div className="sign__group">
                                      <Select
                                        placeholder={"Server"}
                                        options={serverOptions}
                                        styles={customStyles}
                                        required
                                        value={serverOptions.find(
                                          (otp) =>
                                            otp.serverOptions === src.ServerName
                                        )}
                                        onChange={(selected) => {
                                          const copy = [...episodes];
                                          copy[index].sources[
                                            srcIndex
                                          ].ServerName = selected.value;
                                          setEpisodes(copy);
                                        }}
                                      />
                                    </div>
                                  </div>

                                  <div className="col-12">
                                    <div className="sign__group">
                                      <input
                                        type="url"
                                        className="sign__input"
                                        placeholder="Link_embed"
                                        required
                                        value={src.Link_embed}
                                        onChange={(e) => {
                                          const copy = [...episodes];
                                          copy[index].sources[
                                            srcIndex
                                          ].Link_embed = e.target.value;
                                          setEpisodes(copy);
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
                                          const copy = [...episodes];
                                          copy[index].sources[
                                            srcIndex
                                          ].Link_m3u8 = e.target.value;
                                          setEpisodes(copy);
                                        }}
                                      />
                                    </div>
                                  </div>
                                </div>
                              ))}
                            </div>
                          </div>
                          {/* <!-- end episode --> */}
                        </div>
                      ))}
                      {/* <!-- end season --> */}
                    </div>
                  </div>
                )}
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

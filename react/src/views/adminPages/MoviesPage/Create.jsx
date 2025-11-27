import React, { useEffect, useRef, useState } from "react";
import axiosClient from "../../axios-client";
import Select from "react-select";
export default function Create() {
  const initialized = useRef(false);
  const [actors, setActors] = useState([]);
  const [genres, setGenres] = useState([]);
  const [directors, setDirectors] = useState([]);
  const [countries, setCountries] = useState([]);
  const [types, setTypes] = useState([]);
  const [loading, setLoading] = useState(false);
  const slimActors = useRef(null);
  const [formData, setFormData] = useState({
    moviesName: "",
    description: "",
    status: "",
    evaluate: "",
    link: "",
    year: "",
    genresID: "",
    ActorID: [],
    directorsID: [],
    countriesID: [],
    typesID: [],
  });
  const onCreate = (ev) => {
    ev.preventDefault();
    const payLoad = [];
  };
  const statusOptions = [
    { value: "Full HD", label: "Full HD" },
    { value: "Bản cam", label: "Bản cam" },
    { value: "Trailer", label: "Trailer" },
    { value: "Sắp ra mắt", label: "Sắp ra mắt" },
    { value: "Đã hoàn thành", label: "Đã hoàn thành" },
  ];

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
        setLoading(false);
      })
      .catch((err) => {
        setLoading(false);
      });
  }, []);

  useEffect(() => {
    const ready =
      genres.length &&
      types.length &&
      countries.length &&
      actors.length &&
      directors.length;
    if (
      ready &&
      window.SlimSelect &&
      !initialized.current &&
      document.querySelector("#selectjs_quality")
    ) {
      // Chỉ tạo khi DOM select có thật
      new SlimSelect({
        select: "#selectjs_quality",
        placeholder: "Trạng thái",
        data: [
          { text: "Full HD", value: "Full HD" },
          { text: "Bản cam", value: "Bản cam" },
          { text: "Trailer", value: "Trailer" },
          { text: "Sắp ra mắt", value: "Sắp ra mắt" },
          { text: "Đã hoàn thành", value: "Đã hoàn thành" },
        ],
        onChange: (info) => {
          console.log("SlimSelect changed:", info.value); // kiểm tra callback
          setFormData((prev) => ({ ...prev, status: info.value }));
        },
      });
      initialized.current = true;
    }
  }, [genres, types, actors, directors, countries]);
  // useEffect này sẽ chạy MỖI KHI formData thay đổi

  const [status, setStatus] = useState(null);

  const customStyles = {
    control: (provided) => ({
      ...provided,
      backgroundColor: "#1e1e1e", // nền input
      borderColor: "#333",
      color: "white",
    }),
    menu: (provided) => ({
      ...provided,
      backgroundColor: "#1e1e1e", // nền dropdown
      color: "white",
    }),
    option: (provided, state) => ({
      ...provided,
      backgroundColor: state.isSelected
        ? "#f5a623" // vàng khi chọn
        : state.isFocused
        ? "#333" // nền hover
        : "#1e1e1e", // nền bình thường
      color: state.isSelected ? "white" : "white",
      cursor: "pointer",
    }),
    singleValue: (provided) => ({
      ...provided,
      color: "white",
    }),
    placeholder: (provided) => ({
      ...provided,
      color: "#aaa",
    }),
    input: (provided) => ({
      ...provided,
      color: "white",
    }),
  };

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
                                moviesName: e.target.value,
                              })
                            }
                          />
                        </div>
                      </div>

                      <Select
                        options={statusOptions}
                        value={status}
                        onChange={setStatus}
                        styles={customStyles}
                        placeholder="Chọn trạng thái"
                        multiple
                      />

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
                                description: e.target.value,
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
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-12 col-xl-5">
                    <div className="row">
                      <div className="col-12 col-md-6">
                        <div className="sign__group">
                          <select
                            name="MovieStatus"
                            className="sign__selectjs"
                            id="selectjs_quality"
                            // value={formData.status || ""}
                            // onChange={(e) =>
                            //   setFormData({
                            //     ...formData,
                            //     status: e.target.value,
                            //   })
                            // }
                          ></select>
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
                                evaluate: e.target.value,
                              })
                            }
                          />
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <select
                            name="GenreID"
                            className="sign__selectjs"
                            id="selectjs_genres"
                            onChange={(e) =>
                              setFormData({
                                ...formData,
                                genresID: e.target.value,
                              })
                            }
                          >
                            {genres.map((g) => (
                              <option key={g.GenreID} value={g.GenreID}>
                                {g.GenreName}
                              </option>
                            ))}
                          </select>
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <select
                            name="TypeID[]"
                            className="sign__selectjs"
                            id="selectjs_types"
                            data-placeholder="Chọn chất lượng"
                            multiple
                          >
                            {types.map((t) => (
                              <option key={t.TypeID} value={t.TypeID}>
                                {t.TypeName}
                              </option>
                            ))}
                          </select>
                        </div>
                      </div>

                      <div className="col-12">
                        <div className="sign__group">
                          <select
                            name="CountryID[]"
                            className="sign__selectjs"
                            id="selectjs__country"
                            multiple
                          >
                            {countries.map((c) => (
                              <option key={c.CountryID} value={c.CountryID}>
                                {c.CountryName}
                              </option>
                            ))}
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="col-12 col-md-6 col-xl-4">
                    <div className="sign__group">
                      <select
                        name="DirectorID[]"
                        className="sign__selectjs"
                        id="selectjs__director"
                        multiple
                      >
                        {directors.map((d) => (
                          <option key={d.DirectorID} value={d.DirectorID}>
                            {d.DirectorName}
                          </option>
                        ))}
                      </select>
                    </div>
                  </div>
                  <div className="col-12 col-md-6 col-xl-8">
                    <div className="sign__group">
                      <select
                        name="ActorID[]"
                        className="sign__selectjs"
                        id="selectjs__actors"
                        multiple
                      >
                        {actors.map((a) => (
                          <option key={a.ActorID} value={a.ActorID}>
                            {a.ActorName}
                          </option>
                        ))}
                      </select>
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

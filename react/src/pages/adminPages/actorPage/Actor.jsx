import React, { useEffect, useRef, useState } from "react";
import axiosClient from "../../axios-client";
import Select from "react-select";
import { Link } from "react-router-dom";
import { customStyles } from "../../../../public/js/selectReact";

export default function Actor() {
  const [actors, setActor] = useState([]);
  const [loading, setLoading] = useState(false);
  const [deleteActor, setDeleteActor] = useState();
  const [countries, setContries] = useState();
  const nameRef = useRef();
  const dateRef = useRef();
  const imageFileRef = useRef(null);
  const [country, setCountry] = useState("");
  const [errors, setErrors] = useState([]);
  const [errorUpdate, setErrorUpdate] = useState([]);
  const [meta, setMeta] = useState({});
  const [page, setPage] = useState(1);
  const [formData, setFormData] = useState({
    ActorID: "",
    ActorName: "",
    ActorNationality: "",
    ActorDate: "",
    ActorAvatar: null,
  });
  useEffect(() => {
    getActor();
  }, []);
  const getActor = (url = `/actors?page=${page}`) => {
    setLoading(true);
    axiosClient
      .get(url)
      .then(({ data }) => {
        setMeta(data.meta);
        setActor(data.data);
        setContries(
          data.countries.map((c) => ({
            value: c.CountryName,
            label: c.CountryName,
          }))
        );
        setLoading(false);
      })
      .catch((er) => {});
  };
  const onDelete = (ev, id) => {
    ev.preventDefault();
    axiosClient
      .delete(`/actors/${id}`)
      .then(({ data }) => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("delete_actor_modal")
        );
        modal.hide();
        getActor();
        iziToast.success({
          message: data,
          position: "topRight",
        });
      })
      .catch((er) => {});
  };
  const onCreate = (ev) => {
    ev.preventDefault();
    const fd = new FormData();
    fd.append("ActorName", nameRef.current.value);
    if (country) {
      fd.append("ActorNationality", country);
    }
    if (dateRef.current.value) {
      fd.append("ActorDate", dateRef.current.value);
    }
    if (imageFileRef.current instanceof File) {
      fd.append("ActorAvatar", imageFileRef.current);
    }

    axiosClient
      .post("/actors", fd)
      .then(({ data }) => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modal_create_actor")
        );
        modal.hide();
        getActor();
        iziToast.success({
          message: data,
          position: "topRight",
        });
      })
      .catch((er) => {
        setErrors(er.response.data.errors);
      });
  };
  const onUpdate = (ev) => {
    ev.preventDefault();
    const fd = new FormData();
    fd.append("ActorName", formData.ActorName);
    if (formData.ActorNationality) {
      fd.append("ActorNationality", formData.ActorNationality);
    }
    if (formData.ActorDate) {
      fd.append("ActorDate", formData.ActorDate);
    }
    if (formData.ActorAvatar instanceof File) {
      fd.append("ActorAvatar", formData.ActorAvatar);
    }
    fd.append("_method", "PUT");
    axiosClient
      .post(`/actors/${formData.ActorID}`, fd, {
        headers: { "Content-Type": "multipart/form-data" },
      })
      .then(({ data }) => {
        getActor();
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modal_update_actor")
        );
        modal.hide();
        iziToast.success({
          message: data,
          position: "topRight",
        });
      })
      .catch((er) => {
        setErrorUpdate(er.response.data.errors);
      });
  };

  return (
    <main className="main">
      <div className="container-fluid">
        <div className="row">
          {/* <!-- main title --> */}
          <div className="col-12">
            <div className="main__title">
              <h2>Đạo diễn</h2>

              <div className="main__title-wrap">
                <button
                  type="button"
                  className="main__title-link main__title-link--wrap"
                  onClick={() => {
                    const el = document.getElementById("modal_create_actor");
                    const modal = bootstrap.Modal.getOrCreateInstance(el);
                    modal.show();
                  }}
                >
                  Thêm mới
                </button>
                <form className="filter__select">
                  <select
                    name="sort"
                    className="filter__select"
                    id="filter__sort"
                  >
                    <option value="Tên">Tên đạo diễn</option>
                    <option value="Ngày sinh">Ngày sinh</option>
                    <option value="Quốc tịch">Quốc tịch</option>
                  </select>
                </form>

                {/* <!-- search --> */}
                <form className="main__title-form">
                  <input name="search" type="text" placeholder="Tìm kiếm...." />
                  <button type="submit">
                    <i className="bi bi-search"></i>
                  </button>
                </form>
                {/* <!-- end search --> */}
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
                    <th>ẢNH ĐẠI DIỆN</th>
                    <th>QUỐC TỊCH</th>
                    <th>NGÀY SINH</th>
                    <th></th>
                  </tr>
                </thead>
                {loading && (
                  <tbody>
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
                  </tbody>
                )}
                {!loading && (
                  <tbody>
                    {actors.map((at, index) => (
                      <tr key={at.ActorID}>
                        <td>
                          <div className="catalog__text">{index + 1}</div>
                        </td>
                        <td>
                          <div className="catalog__text">{at.ActorName}</div>
                        </td>
                        <td>
                          <div className="catalog__user">
                            <div className="catalog__avatar">
                              <img src="#" alt="" />
                            </div>
                          </div>
                        </td>
                        <td>
                          <div className="catalog__text">
                            {at.ActorNationality
                              ? at.ActorNationality
                              : "Đang cập nhật"}
                          </div>
                        </td>

                        <td>
                          <div className="catalog__text">
                            {at.ActorDate ? at.ActorDate : "Đang cập nhật"}
                          </div>
                        </td>
                        <td>
                          <div className="catalog__btns">
                            <button
                              href="#"
                              className="catalog__btn catalog__btn--edit"
                              onClick={() => {
                                const modal =
                                  bootstrap.Modal.getOrCreateInstance(
                                    document.getElementById(
                                      "modal_update_actor"
                                    )
                                  );
                                modal.show();
                                setFormData(() => ({
                                  ActorID: at.ActorID,
                                  ActorName: at.ActorName,
                                  ActorNationality: at.ActorNationality,
                                  ActorDate: at.ActorDate,
                                  ActorAvatar: at.ActorAvatar,
                                }));
                              }}
                            >
                              <i className="bi bi-pencil-square"></i>
                            </button>
                            <button
                              type="button"
                              className="catalog__btn catalog__btn--delete"
                              onClick={() => {
                                setDeleteActor({
                                  id: at.ActorID,
                                });
                                const el =
                                  document.getElementById("delete_actor_modal");
                                const modal =
                                  bootstrap.Modal.getOrCreateInstance(el);
                                modal.show();
                              }}
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
                            <button onClick={() => getActor(link.url)}>
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
                            <button onClick={() => getActor(link.url)}>
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
                            <button onClick={() => getActor(link.url)}>
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
                            <button onClick={() => getActor(link.url)}>
                              <i className="bi bi-chevron-right"></i>
                            </button>
                          </li>
                        );
                      }
                      return (
                        <li
                          key={index}
                          className={`paginator__item ${
                            link.active === true
                              ? "paginator__item--active"
                              : ""
                          }`}
                        >
                          <button onClick={() => getActor(link.url)}>
                            {link.label}
                          </button>
                        </li>
                      );
                    })}
                  </ul>
                </div>
              </div>
            )}
            {/* <!-- end paginator --> */}
          </div>
        </div>
      </div>

      {/* modal tao diector */}
      <div
        className="modal fade"
        id="modal_create_actor"
        tabIndex="-1"
        aria-labelledby="modal-user"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-dialog-centered">
          <div className="modal-content">
            <div className="modal__content">
              <form onSubmit={onCreate} className="modal__form">
                <h4 className="modal__title">Thêm mới</h4>

                <div className="col-12">
                  <div className="sign__group">
                    <label className="sign__label">Tên diễn viên</label>
                    {errors.ActorName && (
                      <div>
                        {errors.ActorName.map((key, index) => (
                          <p
                            className="text-danger"
                            style={{ margin: 0 }}
                            key={key}
                          >
                            {errors.ActorName?.[index]}
                          </p>
                        ))}
                      </div>
                    )}
                    <input
                      ref={nameRef}
                      onFocus={() =>
                        setErrors({
                          ...errors,
                          ActorName: null,
                        })
                      }
                      type="text"
                      className="sign__input"
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label">Quốc gia</label>
                      <Select
                        options={countries}
                        value={countries?.find((opt) => opt.value === country)}
                        onChange={(selected) => {
                          setCountry(selected.value);
                        }}
                        type="text"
                        styles={customStyles}
                        placeholder={"Chọn quốc gia"}
                      />
                    </div>
                  </div>

                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label"></label>
                      <input
                        ref={dateRef}
                        type="date"
                        className="sign__input"
                      />
                    </div>
                  </div>
                  <div className="col-12">
                    <label htmlFor="" className="sign__label">
                      Ảnh đại diện
                    </label>
                    <div className="sign__video">
                      <label
                        id="movie1"
                        className=" d-inline-flex align-items-center justify-content-between w-100"
                        style={{ height: "46px", paddingRight: "30px" }}
                      >
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
                        onChange={(e) => {
                          imageFileRef.current = e.target.files[0];
                        }}
                      />
                    </div>
                  </div>

                  <div className="col-12 col-lg-6 offset-lg-3">
                    <button
                      type="submit"
                      className="sign__btn sign__btn--modal"
                    >
                      Thêm
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {/* end modal tạo diector */}

      {/* <!-- modal-delete --> */}
      <div
        className="modal fade"
        id="delete_actor_modal"
        tabIndex="-1"
        aria-labelledby="modal-delete"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-dialog-centered">
          <div className="modal-content">
            <div className="modal__content">
              <form>
                <h4 className="modal__title">Cảnh bảo</h4>

                <p className="modal__text mx-auto">
                  bạn có chắc muốn xóa thông tin tác giả này không?
                </p>

                <div className="modal__btns">
                  <button
                    className="modal__btn modal__btn--apply"
                    type="button"
                    onClick={(ev) => {
                      onDelete(ev, deleteActor.id);
                    }}
                  >
                    <span>xóa</span>
                  </button>
                  <button
                    className="modal__btn modal__btn--dismiss"
                    type="button"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  >
                    <span>quay lại</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {/* modal cap nhat diector */}
      <div
        className="modal fade"
        id="modal_update_actor"
        tabIndex="-1"
        aria-labelledby="modal-user"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-dialog-centered">
          <div className="modal-content">
            <div className="modal__content">
              <form onSubmit={onUpdate} className="modal__form">
                <h4 className="modal__title">Cập nhật thông tin</h4>

                <div className="col-12">
                  <div className="sign__group">
                    <label className="sign__label">Tên tác giả</label>
                    {errorUpdate?.ActorName?.map((key, index) => (
                      <p
                        className="text-danger"
                        style={{ margin: 0 }}
                        key={key}
                      >
                        {errorUpdate.ActorName[index]}
                      </p>
                    ))}
                    <input
                      value={formData.ActorName}
                      onChange={(e) => {
                        setFormData({
                          ...formData,
                          ActorName: e.target.value,
                        });
                      }}
                      onFocus={() =>
                        setErrorUpdate({
                          ...errorUpdate,
                          ActorName: null,
                        })
                      }
                      type="text"
                      className="sign__input"
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label">Quốc gia</label>
                      <Select
                        options={countries}
                        value={countries?.find(
                          (opt) => opt.value === formData.ActorNationality
                        )}
                        onChange={(selected) => {
                          setFormData({
                            ...formData,
                            ActorNationality: selected.value,
                          });
                        }}
                        type="text"
                        styles={customStyles}
                        placeholder={"Chọn quốc gia"}
                      />
                    </div>
                  </div>

                  <div className="col-12">
                    <div className="sign__group">
                      <label className="sign__label"></label>
                      <input
                        value={formData.ActorDate}
                        onChange={(e) => {
                          setFormData({
                            ...formData,
                            ActorDate: e.target.value,
                          });
                        }}
                        type="date"
                        className="sign__input"
                      />
                    </div>
                  </div>
                  <div className="col-12">
                    <label htmlFor="" className="sign__label">
                      Ảnh đại diện
                    </label>
                    <div className="sign__video">
                      <label
                        id="movie1"
                        className=" d-inline-flex align-items-center justify-content-between w-100"
                        style={{ height: "46px", paddingRight: "30px" }}
                      >
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
                        onChange={(e) => {
                          setFormData({
                            ...formData,
                            ActorAvatar: e.target.files[0],
                          });
                        }}
                      />
                    </div>
                  </div>

                  <div className="col-12 col-lg-6 offset-lg-3">
                    <button
                      type="submit"
                      className="sign__btn sign__btn--modal"
                    >
                      Lưu
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {/* end modal cap nhat diector */}
    </main>
  );
}

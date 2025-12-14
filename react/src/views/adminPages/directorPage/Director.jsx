import React, { useEffect, useRef, useState } from "react";
import axiosClient from "../../axios-client";
import Select from "react-select";
import { Link } from "react-router-dom";
import { customStyles } from "../../../../public/js/selectReact";
export default function Director() {
  const [director, setDirector] = useState([]);
  const [loading, setLoading] = useState(false);
  const [deleteDirector, setDeleteDirector] = useState();
  const [countries, setContries] = useState();

  const [formData, setFormData] = useState({
    DirectorID: "",
    DirectorName: "",
    DirectorNationality: "",
    DirectorDate: "",
    DirectorAvatar: null,
  });

  const nameRef = useRef();
  const dateRef = useRef();
  const imageFileRef = useRef(null);
  const [country, setCountry] = useState();

  console.log(imageFileRef.current);

  useEffect(() => {
    getDirector();
  }, []);
  const getDirector = () => {
    setLoading(true);
    axiosClient
      .get("/directors")
      .then(({ data }) => {
        setDirector(data.directors);
        setContries(
          data.Countries.map((c) => ({
            value: c.CountryName,
            label: c.CountryName,
          }))
        );
        setLoading(false);
      })
      .catch((er) => {
        console.log(er);
      });
  };
  console.log(countries);
  const onDelete = (ev, id) => {
    ev.preventDefault();
    axiosClient
      .delete(`/directors/${id}`)
      .then(({ data }) => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("delete_director_modal")
        );
        modal.hide();
        getDirector();
        iziToast.success({
          message: data,
          position: "topRight",
        });
      })
      .catch((er) => {
        console.log(er);
      });
  };
  console.log(formData);
  const onCreate = (ev) => {
    ev.preventDefault();
    const fd = new FormData();
    fd.append("DirectorName", nameRef.current.value);
    fd.append("DirectorNationality", country);
    fd.append("DirectorDate", dateRef.current.value);
    if (imageFileRef.current instanceof File) {
      fd.append("DirectorAvatar", imageFileRef.current);
    }

    axiosClient
      .post("/directors", fd)
      .then(({ data }) => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modal_create_director")
        );
        modal.hide();
        getDirector();
        iziToast.success({
          message: data,
          position: "topRight",
        });
      })
      .catch((er) => {
        console.log(er);
      });
  };

  const onUpdate = (ev, id) => {
    ev.preventDefault()
    const fd = new FormData()
       fd.append("DirectorName", formData.DirectorName);
    fd.append("DirectorNationality", formData.DirectorNationality);
    fd.append("DirectorDate", formData.DirectorDate);
    if (formData.DirectorAvatar instanceof File) {
      fd.append("DirectorAvatar", formData.DirectorAvatar);
    }
    fd.append("_method", "PUT")
    axiosClient.post(`/directors/${id}`,
      {headers: {"Content_Type" : "multipart/form_data"}}
    )
    .then(({data})=> {
      console.log(data)
    })
    .catch((er) => {
      console.log(er)
    })
  }

  console.log(director);
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
                  to="/directors/create"
                  type="button"
                  className="main__title-link main__title-link--wrap"
                  onClick={() => {
                    const el = document.getElementById("modal_create_director");
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
                    onchange="this.form.submit()"
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
                    {director.map((dr, index) => (
                      <tr>
                        <td>
                          <div className="catalog__text">{index + 1}</div>
                        </td>
                        <td>
                          <div className="catalog__text">{dr.DirectorName}</div>
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
                            {dr.DirectorNationality}
                          </div>
                        </td>

                        <td>
                          <div className="catalog__text">{dr.DirectorDate}</div>
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
                                      "modal_update_director"
                                    )
                                  );
                                modal.show();
                                setFormData(() => ({
                                  DirectorID: dr.DirectorID,
                                  DirectorName: dr.DirectorName,
                                  DirectorNationality: dr.DirectorNationality,
                                  DirectorDate: dr.DirectorDate,
                                  DirectorAvatar: dr.DirectorAvatar,
                                }));
                              }}
                            >
                              <i className="bi bi-pencil-square"></i>
                            </button>
                            <button
                              type="button"
                              data-bs-toggle="modal"
                              className="catalog__btn catalog__btn--delete"
                              onClick={() => {
                                setDeleteDirector({
                                  id: dr.DirectorID,
                                });
                                const el = document.getElementById(
                                  "delete_director_modal"
                                );
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
          </div>
        </div>
      </div>

      {/* modal tao diector */}
      <div
        className="modal fade"
        id="modal_create_director"
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
                    <label className="sign__label">Tên tác giả</label>
                    <input ref={nameRef} type="text" className="sign__input" />
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
        id="delete_director_modal"
        tabindex="-1"
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
                      onDelete(ev, deleteDirector.id);
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
      {/* modal tao diector */}
      <div
        className="modal fade"
        id="modal_update_director"
        tabIndex="-1"
        aria-labelledby="modal-user"
        aria-hidden="true"
      >
        <div className="modal-dialog modal-dialog-centered">
          <div className="modal-content">
            <div className="modal__content">
              <form onSubmit={onUpdate(ev, formData.DirectorID)} className="modal__form">
                <h4 className="modal__title">Cập nhật thông tin</h4>

                <div className="col-12">
                  <div className="sign__group">
                    <label className="sign__label">Tên tác giả</label>
                    <input
                      value={formData.DirectorName}
                      onChange={(e) => {
                        setFormData({
                          ...formData,
                          DirectorName: e.target.value,
                        });
                      }}
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
                        value={countries?.find((opt) => opt.value === formData.DirectorNationality)}
                        onChange={(selected) => {
                          setFormData({
                            ...formData,
                            DirectorNationality: selected.value
                          })
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
                        value={formData.DirectorDate}
                        onChange={(e) => {
                          setFormData({
                            ...formData,
                            DirectorDate: e.target.value
                          })
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
                            DirectorAvatar: e.target.files[0]
                          })
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
    </main>
  );
}

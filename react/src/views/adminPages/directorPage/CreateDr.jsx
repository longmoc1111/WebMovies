import React from "react";

export default function CreateDr() {
  return (
    <main class="main">
      <div class="container-fluid">
        <div class="row">
          {/* <!-- main title --> */}
          <div class="col-12">
            <div class="main__title">
              <h2>Thêm mới đạo diễn</h2>
            </div>
          </div>
          <div class="tab-content">
            <div
              class="tab-pane fade show active"
              id="tab-1"
              role="tabpanel"
              aria-labelledby="1-tab"
              tabindex="0"
            >
              <div class="col-12 mx-auto">
                <div class="row">
                  <div class="col-12">
                    <form
                      class="sign__form sign__form--profile"
                      enctype="multipart/form-data"
                    >
                      <div class="row">
                        <div class="col-12">
                          <div class="sign__group">
                            <label class="sign__label" for="username">
                              Họ tên
                            </label>
                            <input
                              id="username"
                              type="text"
                              name="DirectorName"
                              class="sign__input"
                            />
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="sign__group">
                            <label class="sign__label" for="username">
                              Quốc tịch
                            </label>
                            <select
                              name="DirectorNationality"
                              class="sign__selectjs"
                              id="sign__country"
                            >
                              <option value="" selected></option>
                            </select>
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="sign__group">
                            <label class="sign__label" for="fname">
                              ngày sinh
                            </label>
                            <input
                              id="fname"
                              type="date"
                              name="DirectorDate"
                              class="sign__input"
                            />
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="sign__group">
                            <label class="sign__label" for="fname">
                              Ảnh đại diện
                            </label>
                            <div class="collapse show multi-collapse">
                              <div class="sign__video position-relative">
                                <label
                                  id="movie1"
                                  for="sign__video-upload"
                                  class="position-relative d-inline-flex align-items-center justify-content-between w-100"
                                  style={{ height: "46px", paddingRight: "30px" }}
                                >
                                  <i
                                    class="bi bi-image"
                                    style={{ fontSize: "20px" }}
                                  ></i>
                                </label>
                                <input
                                  data-name="#movie1"
                                  id="sign__video-upload"
                                  name="DirectorAvatar"
                                  class="sign__video-upload"
                                  type="file"
                                />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <button
                            class="sign__btn sign__btn--small"
                            type="submit"
                          >
                            <span>Lưu</span>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  );
}

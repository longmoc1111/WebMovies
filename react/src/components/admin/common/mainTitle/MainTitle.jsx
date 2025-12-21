import React from "react";

export default function MainTitle({title, onSearch, onSort, sortOption = []}) {
  return (
    <div className="col-12">
      <div className="main__title">
        <h2>{title}</h2>

        <div className="main__title-wrap">
          <button
            type="button"
            data-bs-toggle="modal"
            className="main__title-link main__title-link--wrap"
            data-bs-target="#modal-user"
          >
            Add user
          </button>
          <form action="#" className="filter__select">
            <select
              name="sort"
              className="filter__select"
              id="filter__sort"
              // onChange= {this.form.submit()}
              onChange={onSort}
            >
              {sortOption.map((opt, index) => (
                <option key={index} value={opt.value}>{opt.label}</option>
              ))}
            </select>
          </form>

          <form onSubmit={onSearch} className="main__title-form">
            <input name="search" type="text"  placeholder="Tìm kiếm...." />
            <button type="submit">
              <i className="bi bi-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  );

}

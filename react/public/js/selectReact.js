export const customStyles = {
control: (base, state) => ({
  ...base,
  backgroundColor: "#222028",
  border: state.isFocused ? "2px solid #f9ab00" : "2px solid transparent",  
  borderRadius: 8,
  minHeight: 46,
  boxShadow: "none",
  cursor: "pointer",
  paddingRight: 0,
  position: "relative",
  "&:hover": {                         
    border: "1px solid #f9ab00",
  },
}),


  valueContainer: (base) => ({
    ...base,
    paddingLeft: 12,    
    paddingRight: 42,   
  }),

  placeholder: (base) => ({
    ...base,
    color: "#c0c0c0",
    fontSize: 16,
  }),

  singleValue: (base) => ({
    ...base,
    color: "#fff",
    fontSize: 16,
  }),

  input: (base) => ({
    ...base,
    color: "#fff",
  }),

  multiValue: (base) => ({
    ...base,
    backgroundColor: "#1a191f",
    borderRadius: 8,
    border: "1px solid transparent",
    display: "flex",
    alignItems: "center",
  }),

  multiValueLabel: (base) => ({
    ...base,
    color: "#fff",
    fontSize: 14,
    padding: "0 12px",
  }),

  multiValueRemove: (base) => ({
    ...base,
    color: "#f9ab00",
    ":hover": {
      color: "#eb5757",
      backgroundColor: "transparent",
    },
  }),

  dropdownIndicator: (base) => ({
    ...base,
    padding: 0,
    position: "absolute",
    right: 16, 
    top: "50%",
    transform: "translateY(-50%)",
    width: 20,
    height: 20,
    color: "transparent",
    backgroundImage: `url("../img/angle-down.svg")`,
    backgroundSize: "20px auto",
    backgroundRepeat: "no-repeat",
    backgroundPosition: "center",
  }),

  indicatorSeparator: () => ({
    display: "none",
  }),

  menu: (base) => ({
    ...base,
    backgroundColor: "#222028",
    borderRadius: 8,
    padding: "15px 20px",
    marginTop: 8,
  }),

  menuList: (base) => ({
    ...base,
    padding: 0,
  }),

  option: (base, state) => ({
    ...base,
    backgroundColor: "transparent",
    color: state.isSelected ? "#f9ab00" : "#fff",
    fontSize: 16,
    lineHeight: "38px",
    cursor: "pointer",
    ":hover": {
      color: "#f9ab00",
      backgroundColor: "transparent",
    },
  }),
};

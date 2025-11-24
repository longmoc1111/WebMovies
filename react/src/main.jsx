import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "./index.css";
import { RouterProvider } from "react-router-dom";
import router from "./router.jsx";
import { ContexProvider } from "./contexts/ContextProvider.jsx";
import { MoviesProvider } from "./contexts/MovieContextProvider.jsx";

createRoot(document.getElementById("root1")).render(
  <StrictMode>
    <ContexProvider>
      <MoviesProvider>
        <RouterProvider router={router} />
      </MoviesProvider>
    </ContexProvider>
  </StrictMode>
);

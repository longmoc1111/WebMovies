import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { RouterProvider } from "react-router-dom";
import router from "./routers/router.jsx";
import { ContexProvider } from "./contexts/ContextProvider.jsx";

createRoot(document.getElementById("root1")).render(
  <StrictMode> 
    <ContexProvider>
        <RouterProvider router={router} />
    </ContexProvider>
   </StrictMode>
);

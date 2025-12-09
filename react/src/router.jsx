import { createBrowserRouter, Navigate } from "react-router-dom";
import Login from "./views/Login";
import Sigup from "./views/signup";
import DashBoard from "./views/DashBoard";
import NotFound from "./views/NotFound";
import DefaultLayout from "./components/DefaultLayout";
import GustLayout from "./components/GustLayout";
import Users from "./views/adminPages/userPages//Users";
import UpdateUser from "./views/adminPages/userPages/Update";
import Moives from "./views/adminPages/moviesPage/Moives";
import Create from "./views/adminPages/MoviesPage/Create";
import Update from "./views/adminPages/MoviesPage/Update";


const router = createBrowserRouter([
  {
    path: "/",
    element: <DefaultLayout />,
    children: [
      {
      path: "/",
      element: <Navigate to = "/users"/>
      },
      
      {
        path:"/dashboard",
        element: <DashBoard/>
      },
      {
        path: "/users",
        element: <Users />,
      },
      {
        path:"/users/update/:id",
        element:<UpdateUser/>
      },
      {
        path:"/movies",
        element:<Moives/>
      },
      {
        path:"/movies/create",
        element:<Create/>
      },
      {
        path:"/movies/update/:id",
        element:<Update/>
      }
    ],
  },
  {
    path: "/",
    element: <GustLayout />,
    children: [
      {
        path: "/login",
        element: <Login />,
      },
      {
        path: "/signup",
        element: <Sigup />,
      },
    ],
  },
  {},
  {
    path: "/*",
    element: <NotFound />,
  },
]);

export default router;

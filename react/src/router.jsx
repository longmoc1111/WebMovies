import { createBrowserRouter, Navigate } from "react-router-dom";
import Login from "./auth/Login";
import Signup from "./auth/Signup";
import DashBoard from "./pages/DashBoard";
import NotFound from "./pages/NotFound";
import GustLayout from "@/layouts/Gust/GustLayout"
import AdminLayout from "@/layouts/Admin/AdminLayout";
import Users from "@adminPages/userPages/Users";
import UpdateUser from "@adminPages/userPages/Update";
import Moives from "@adminPages/moviesPage/Moives";
import Create from "@adminPages/MoviesPage/Create";
import Update from "@adminPages/MoviesPage/Update";
import Director from "@adminPages/directorPage/Director";
import Actor from "@adminPages/actorPage/Actor";



const router = createBrowserRouter([
  {
    path: "/",
    element: <AdminLayout />,
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
      },
      {
        path:"/directors",
        element:<Director/>
      },     
      {
        path:"/actors",
        element:<Actor/>
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
        element: <Signup />,
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

import Home from "@/views/Home";
import { AppRoute } from "@/utils/const";

export const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: AppRoute.EMPLOYEES,
    name: "Employees",
    component: () => import("@/views/Employees"),
  },
  {
    path: AppRoute.LOGIN,
    name: "Login",
    component: () => import("@/views/Login"),
  },
  {
    path: "/about",
    name: "About",
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue"),
  },
];

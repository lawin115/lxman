// resources/js/routes.js
export const routes = {
  home: "/",
  offers: "/offers",
  services: "/services",
  gallery: "/gallery",
  contact: "/contact",
};

export function route(name) {
  return routes[name] || "/";
}

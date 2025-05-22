import "./bootstrap";
import "../css/app.css";

const images = import.meta.glob(
  '../images/*.{png,jpg,jpeg,svg,gif,webp}',
  {
    eager: true,
    import: 'default',
  }
);

import.meta.glob([
    "../logo/**",
    "../portfolio/**",
    "../images/**",
    "../icons/**",
]);

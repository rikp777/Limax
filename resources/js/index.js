
import "../assets/vendor/dropzone.min.css";
import "bootstrap-vue/dist/bootstrap-vue"
import "../assets/vendor/bootstrap.min.css"
import "../assets/vendor/bootstrap.rtl.only.min.css"
import "video.js/dist/video-js.css"

import { defaultColor } from "./constants/config"

let color = defaultColor;

if(localStorage.getItem("themeColor")){
    color = localStorage.getItem("themeColor")
}
let render = () => {
    import("../assets/sass/themes/piaf." + color + ".scss").then(() => {
        require("./app")
    })
};

render();

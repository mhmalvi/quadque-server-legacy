/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import axios from "axios";

require("./bootstrap");

window.Vue = require("vue").default;


import MarqueeText from "vue-marquee-text-component";
import DynamicMarquee from "vue-dynamic-marquee";

/* import the fontawesome core */
import { library } from "@fortawesome/fontawesome-svg-core";

/* import font awesome icon component */
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
// import { service } from "./components/admin/service.vue";
import VueLazyload from "vue-lazyload";
import {
    faTwitter,
    faFacebookF,
    faYoutube,
    faInstagram,
} from "@fortawesome/free-brands-svg-icons";
import Vue from "vue";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
// import "vue-loading-overlay/dist/css/index.css";


// import "mavon-editor/dist/css/index.css";
// // use
// Vue.use(mavonEditor);
library.add(faTwitter, faFacebookF, faYoutube, faInstagram);

Vue.use(VueSweetalert2);
Vue.use(VueLazyload);
Vue.component("marquee-text", MarqueeText);
Vue.component("dynamic-marquee", DynamicMarquee);

/* add font awesome icon component */
Vue.component("font-awesome-icon", FontAwesomeIcon);

// Vue.component("home-component", require("./components/user/Home.vue").default);
Vue.component(
    "login-component",
    require("./components/admin/login.vue").default
);
Vue.component(
    "signup-component",
    require("./components/admin/signup.vue").default
);
Vue.component("home-component", require("./components/admin/home.vue").default);
Vue.component(
    "casestudy-component",
    require("./components/admin/casestudy.vue").default
);
Vue.component(
    "adminblog-component",
    require("./components/admin/blog.vue").default
);
Vue.component(
    "client-speak-component",
    require("./components/admin/clientSpeak.vue").default
);

Vue.component(
    "service-component",
    require("./components/admin/service.vue").default
);
Vue.component(
    "dashboard-component",
    require("./components/admin/dashboard.vue").default
);
Vue.component(
    "about-component",
    require("./components/admin/aboutUs.vue").default
);

if (location.hostname == "127.0.0.1") {
    Vue.prototype.$base = "http://127.0.0.1:8000/#";
    Vue.prototype.$assetbase = "http://127.0.0.1:8000/";
} else if (location.hostname !== "localhost") {
} else {
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
});

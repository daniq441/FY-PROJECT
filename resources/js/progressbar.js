import VueProgressBar from "vue-progressbar.d.ts";

Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    thickness: "3px",
    location: "top",
    transition: {
        speed: ".8s",
        opacity: "1s",
        termination: 2000
    }
});

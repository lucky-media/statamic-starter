import "@fontsource/poppins/latin-ext.css";
import { Demo } from "./alpine/Demo";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("demo", Demo);

Alpine.start();

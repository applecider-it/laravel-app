import axios from "axios";
import Alpine from "alpinejs";
import { App } from "@/services/app/window";

declare global {
    interface Window {
        axios: typeof axios;
        Alpine: typeof Alpine;
        App: typeof App;
    }
}

import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
  root: ".",
  build: {
    outDir: "dist",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        app: path.resolve(__dirname, "app/css/app.css"),
        main: path.resolve(__dirname, "app/js/main.js")
      }
    }
  }
});

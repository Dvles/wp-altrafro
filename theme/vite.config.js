import { defineConfig } from "vite";
import path from "path";

export default defineConfig({
  root: ".",
  build: {
    outDir: "dist",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        app:  path.resolve(__dirname, "app/css/app.css"),
        main: path.resolve(__dirname, "app/js/main.js"),
        editor: 'app/css/editor.css',
      },
      output: {
        // No hashing: always write fixed names
        entryFileNames: "assets/[name].js",
        chunkFileNames: "assets/[name].js",
        assetFileNames: (assetInfo) => {
          // keep css/images/fonts predictable
          return "assets/[name][extname]";
        },
      },
    },
  },
});

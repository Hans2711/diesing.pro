// vite.config.js
import { defineConfig } from "file:///home/diesi/diesing.pro/node_modules/vite/dist/node/index.js";
import laravel from "file:///home/diesi/diesing.pro/node_modules/laravel-vite-plugin/dist/index.js";
import obfuscatorPlugin from "file:///home/diesi/diesing.pro/node_modules/vite-plugin-javascript-obfuscator/dist/index.cjs.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/app.css",
        "resources/css/contact.css",
        "resources/css/diff-table.css",
        "resources/js/app.js",
        "resources/js/notes.js",
        "resources/js/redirects.js",
        "resources/js/files.js",
        "resources/js/parts/password.js",
        "resources/js/contact.js",
        "resources/js/utils/iphone-paralax.js"
      ],
      refresh: true
    }),
    obfuscatorPlugin({
      include: [
        "resources/js/notes.js",
        "resources/js/redirects.js",
        "resources/js/contact.js",
        "resources/js/parts/password.js"
      ],
      apply: "build",
      options: {}
    })
  ],
  server: {
    hmr: {
      host: "localhost"
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvaG9tZS9kaWVzaS9kaWVzaW5nLnByb1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiL2hvbWUvZGllc2kvZGllc2luZy5wcm8vdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL2hvbWUvZGllc2kvZGllc2luZy5wcm8vdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tIFwidml0ZVwiO1xuaW1wb3J0IGxhcmF2ZWwgZnJvbSBcImxhcmF2ZWwtdml0ZS1wbHVnaW5cIjtcbmltcG9ydCBvYmZ1c2NhdG9yUGx1Z2luIGZyb20gXCJ2aXRlLXBsdWdpbi1qYXZhc2NyaXB0LW9iZnVzY2F0b3JcIjtcblxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbiAgcGx1Z2luczogW1xuICAgIGxhcmF2ZWwoe1xuICAgICAgaW5wdXQ6IFtcbiAgICAgICAgXCJyZXNvdXJjZXMvY3NzL2FwcC5jc3NcIixcbiAgICAgICAgXCJyZXNvdXJjZXMvY3NzL2NvbnRhY3QuY3NzXCIsXG4gICAgICAgIFwicmVzb3VyY2VzL2Nzcy9kaWZmLXRhYmxlLmNzc1wiLFxuICAgICAgICBcInJlc291cmNlcy9qcy9hcHAuanNcIixcbiAgICAgICAgXCJyZXNvdXJjZXMvanMvbm90ZXMuanNcIixcbiAgICAgICAgXCJyZXNvdXJjZXMvanMvcmVkaXJlY3RzLmpzXCIsXG4gICAgICAgIFwicmVzb3VyY2VzL2pzL2ZpbGVzLmpzXCIsXG4gICAgICAgIFwicmVzb3VyY2VzL2pzL3BhcnRzL3Bhc3N3b3JkLmpzXCIsXG4gICAgICAgIFwicmVzb3VyY2VzL2pzL2NvbnRhY3QuanNcIixcbiAgICAgICAgXCJyZXNvdXJjZXMvanMvdXRpbHMvaXBob25lLXBhcmFsYXguanNcIixcbiAgICAgIF0sXG4gICAgICByZWZyZXNoOiB0cnVlLFxuICAgIH0pLFxuICAgIG9iZnVzY2F0b3JQbHVnaW4oe1xuICAgICAgaW5jbHVkZTogW1xuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL25vdGVzLmpzXCIsXG4gICAgICAgICAgICAgICAgXCJyZXNvdXJjZXMvanMvcmVkaXJlY3RzLmpzXCIsXG4gICAgICAgICAgICAgICAgXCJyZXNvdXJjZXMvanMvY29udGFjdC5qc1wiLFxuICAgICAgICAgICAgICAgIFwicmVzb3VyY2VzL2pzL3BhcnRzL3Bhc3N3b3JkLmpzXCJcbiAgICAgICAgICAgIF0sXG4gICAgICBhcHBseTogXCJidWlsZFwiLFxuICAgICAgb3B0aW9uczoge30sXG4gICAgfSksXG4gIF0sXG4gIHNlcnZlcjoge1xuICAgIGhtcjoge1xuICAgICAgaG9zdDogXCJsb2NhbGhvc3RcIixcbiAgICB9LFxuICB9LFxufSk7XG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQXVQLFNBQVMsb0JBQW9CO0FBQ3BSLE9BQU8sYUFBYTtBQUNwQixPQUFPLHNCQUFzQjtBQUU3QixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUMxQixTQUFTO0FBQUEsSUFDUCxRQUFRO0FBQUEsTUFDTixPQUFPO0FBQUEsUUFDTDtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLE1BQ0Y7QUFBQSxNQUNBLFNBQVM7QUFBQSxJQUNYLENBQUM7QUFBQSxJQUNELGlCQUFpQjtBQUFBLE1BQ2YsU0FBUztBQUFBLFFBQ0M7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxNQUNKO0FBQUEsTUFDTixPQUFPO0FBQUEsTUFDUCxTQUFTLENBQUM7QUFBQSxJQUNaLENBQUM7QUFBQSxFQUNIO0FBQUEsRUFDQSxRQUFRO0FBQUEsSUFDTixLQUFLO0FBQUEsTUFDSCxNQUFNO0FBQUEsSUFDUjtBQUFBLEVBQ0Y7QUFDRixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=

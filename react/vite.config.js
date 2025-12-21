import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'
import path from "path"

// https://vite.dev/config/
export default defineConfig({
  plugins: [react()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, "./src"),
      '@adminPages': path.resolve(__dirname, "./src/pages/adminPages"),
      '@errors': path.resolve(__dirname, "./src/pages/errors"),
      '@auth' : path.resolve(__dirname, "./src/pages/auth"),
      '@axios': path.resolve(__dirname, "./src/axios")
      
    }
  }
})

import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',    
                'resources/js/app.js',      
                'resources/css/layout.css', 
                'resources/css/home.css',   
                'resources/css/profil.css',
                'resources/css/artikel.css',
                'resources/css/galeri.css',
                'resources/css/produk.css',
                'resources/css/kontak.css',
                'resources/css/login.css',
                'resources/js/main.js',
                'resources/css/admin.css',
                'resources/css/admindashboard.css',
                'resources/css/admin-produk.css'

            ],
            refresh: true,
        }),
    ],
});
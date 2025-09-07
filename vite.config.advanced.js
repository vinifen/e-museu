import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    
    // Configurações de desenvolvimento
    server: {
        host: '0.0.0.0', // Permite acesso pela rede
        port: 5173,
        hmr: {
            host: 'localhost', // Para desenvolvimento local
        },
    },
    
    // Configurações de build
    build: {
        outDir: 'public/build',
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios'],
                    bootstrap: ['bootstrap'],
                },
            },
        },
    },
    
    // Alias para facilitar imports
    resolve: {
        alias: {
            '@': '/resources/js',
            '@css': '/resources/sass',
            '@img': '/resources/images',
        },
    },
    
    // Configurações CSS
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@css/variables.scss";`,
            },
        },
    },
});

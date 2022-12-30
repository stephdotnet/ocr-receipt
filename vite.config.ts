import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
let serverConfig = {};

export default defineConfig(({  mode }) => {
    const env = loadEnv(mode, process.cwd(), 'VITE')
    if(env.VITE_HOST) {
        serverConfig = {
            server: {
                host: env.VITE_HOST,
                hmr: {
                    host: env.VITE_HOST
                }
            }
        }
    }

    return {
        plugins: [
            laravel({
                input: [
                    'resources/src/index.tsx'
                ],
                refresh: true,
            }),
            react()
        ],
        resolve: {
            alias: require('./resources/src/alias.config')
        },
        ...serverConfig
    };
});

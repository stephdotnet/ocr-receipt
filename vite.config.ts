import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import makeTokens from './resources/src/assets/css/tokens';

const path = require('path');
let serverConfig = {};

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), 'VITE');
  if (env.VITE_HOST) {
    serverConfig = {
      server: {
        host: env.VITE_HOST,
        hmr: {
          host: env.VITE_HOST,
        },
      },
    };
  }

  return {
    plugins: [
      laravel({
        input: ['resources/src/index.tsx'],
        refresh: true,
      }),
      react(),
    ],
    resolve: {
      alias: {
        '@': path.resolve(__dirname, 'resources', 'src'),
        '@pages': path.resolve(__dirname, 'resources', 'src', 'pages'),
        '@css': path.resolve(__dirname, 'resources', 'src', 'assets', 'css'),
        '@hooks': path.resolve(__dirname, 'resources', 'src', 'hooks'),
        '@components': path.resolve(__dirname, 'resources', 'src', 'components'),
        '@layouts': path.resolve(__dirname, 'resources', 'src', 'layouts'),
      },
    },
    server: {
      open: true,
    },
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: makeTokens(),
        },
      },
    },
    ...serverConfig,
  };
});

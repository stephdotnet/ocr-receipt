const path = require('path');
const src = __dirname;

module.exports = {
    '@': path.resolve(src),
    '@pages': path.resolve(src, 'pages'),
    '@css': path.resolve(src, 'assets', 'css'),
    '@hooks': path.resolve(src, 'hooks'),
    '@components': path.resolve(src, 'components'),
    '@layouts': path.resolve(src, 'layouts'),
}
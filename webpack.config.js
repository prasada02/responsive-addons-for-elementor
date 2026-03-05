const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
    ...defaultConfig,

    entry: {
        frontend: './assets/dev/js/frontend/rael-frontend.js',
    },

    output: {
        ...defaultConfig.output,
        path: path.resolve(__dirname, 'assets/dist'),
        filename: '[name].js',
    },
};
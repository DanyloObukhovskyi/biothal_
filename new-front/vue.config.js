const path = require('path');

module.exports = {
    devServer: {
        hot: true
    },
    configureWebpack: {
        resolve: {
            alias: {
                "@": path.resolve(__dirname, 'src/')
            }
        }
    },
}

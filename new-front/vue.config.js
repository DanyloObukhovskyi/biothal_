const path = require('path');

const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CompressionPlugin = require("compression-webpack-plugin");
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const { VuetifyLoaderPlugin } = require('vuetify-loader')

module.exports = {
  devServer: {
    hot: true,
    port: process.env.VUE_APP_WEB_PORT
  },

  configureWebpack: {
    resolve: {
      alias: {
        "@": path.resolve(__dirname, 'src/')
      }
    },
      plugins: [
          new CompressionPlugin({
              algorithm: "gzip",
              test: /\.js(\?.*)?$/i,
              exclude: '/node_modules/',
          })
      ],
    module: {
        rules: [

        ],
    },
    optimization: {
        minimizer: [new UglifyJsPlugin()],
    },
  },

}

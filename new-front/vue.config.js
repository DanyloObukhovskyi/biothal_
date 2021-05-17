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
          new ImageminPlugin({}),
          new CompressionPlugin({
              algorithm: "gzip",
              test: /\.js(\?.*)?$/i,
              exclude: '/node_modules/',
          }),
          new VuetifyLoaderPlugin()
      ],
    module: {
        rules: [
            {
                test: /\.(png|jpe?g|webp|git|svg|)$/i,
                loader: 'img-optimize-loader'
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        scss: 'vue-style-loader!css-loader!sass-loader', // <style lang="scss">
                        js: 'babel-loader',
                        jsx: 'babel-loader'
                    }
                }
            },
            {
                test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'file-loader',
                options: {
                    name: '[name].[ext]',
                    outputPath: 'fonts'
                }
            }
        ],
    },
    optimization: {
        minimizer: [new UglifyJsPlugin()],
    },
  },

}

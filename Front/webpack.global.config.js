// Load config vars
const config = require('./config')
// Plugins
const path = require('path')
const webpack = require('webpack')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin')
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin')
const ImageminPlugin = require("imagemin-webpack");


module.exports = {
  entry: {
    app : [
      './src/js/app.js',
      './src/scss/app.scss'
    ]
  },
  output: {
    path: path.resolve(__dirname, `../${config.distDirName}/`),
    publicPath: '/',//`${config.rootDir}/${config.publicPath}/${config.themeName}/${config.distDirName}/`,
    filename: 'js/[name].js'
  },
  resolve: {
    alias: {
      foundation_scss: path.resolve(__dirname, './node_modules/foundation-sites/scss'),
      foundation_js: path.resolve(__dirname, './node_modules/foundation-sites/js')
    }
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /node_modules\/(?!(swiper|gsap|foundation-sites)\/).*/,
        use: ['babel-loader']
      },
      {
        test: /\.css$/i,
        exclude: /node_modules\/(?!(swiper|gsap|foundation-sites)\/).*/,
        use: ['style-loader', 'css-loader'],
      },
      {
        test: /\.(woff2?|ttf|eot)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'fonts/'
            }
          }
        ]
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: '/images/',
              publicPath: '../images/',
            }
          },
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: 'css/[name].css',
      chunkFilename: 'css/[id].css'
    }),
    new ImageminPlugin({
      bail: false,
      cache: true,
      imageminOptions: {
        plugins: [
          ["gifsicle", { interlaced: true }],
          ["jpegtran", { progressive: true }],
          ["optipng", { optimizationLevel: 5 }],
          [
            "svgo",
            {
              plugins: [
                {
                  removeViewBox: false
                }
              ]
            }
          ]
        ]
      }
    }),
    new CopyWebpackPlugin([
      { from: './src/images/', to: './images/'}
    ]),
    new FriendlyErrorsWebpackPlugin()
  ]
}

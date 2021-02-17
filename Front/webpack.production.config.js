// Load config vars
const config = require('./config')
// Load global webpack config
const globalWebpackConfig = require('./webpack.global.config.js')
// Plugins
const path = require('path')
const webpack = require('webpack')
const webpackMerge = require('webpack-merge')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

/**
 * WebPack dev configuration
 *
 */
module.exports = webpackMerge(globalWebpackConfig, {
  mode: 'production',
  module: {
    rules: [
      {
        test: /\.scss$/,
        exclude: /node_modules\/(?!(swiper|gsap|foundation-sites)\/).*/,
        use: [
          { loader: MiniCssExtractPlugin.loader },
          'css-loader',
          'postcss-loader',
          'sass-loader',
        ]
      },
    ]
  },
  plugins: [
    new CleanWebpackPlugin({
      dry: false,
      verbose: true
    })
  ]
})

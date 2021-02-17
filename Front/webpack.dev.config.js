// Load config vars
const config = require('./config')
// Load global webpack config
const globalWebpackConfig = require('./webpack.global.config.js')
// Plugins
const path = require('path')
const webpack = require('webpack')
const webpackMerge = require('webpack-merge')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

/**
 * WebPack dev configuration
 */
module.exports = webpackMerge(globalWebpackConfig, {
  mode: 'development',
  watch: true,
  devtool: 'eval-cheap-module-source-map',
  module: {
    rules: [
      {
        test: /\.s?[ac]ss$/,
        exclude: /node_modules\/(?!(swiper|gsap|foundation-sites)\/).*/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              hmr: true
            },
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true
            }
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: true
            }
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true
            }
          }
        ]
      },
    ]
  },
  plugins: [
    new BrowserSyncPlugin({
      files: ['../**/*.twig', '../**/*.php'],
      proxy: config.hostName,
      port: 3000,
      open: true
    },
    {
      reload: true,
      injectCss: true
    })
  ]
})

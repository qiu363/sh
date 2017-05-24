var webpack = require('webpack');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var path = require('path');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var TransferWebpackPlugin = require('transfer-webpack-plugin');

module.exports = {
    entry: {
      index: './src/main.js'
    },
    output: {
        path: './build/',
        publicPath: "./",
        filename: 'main.js'
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loader: 'babel?presets=es2015',
                include: path.join(__dirname, 'src')
            }, {
                test: /\.css$/,
                loaders: ['style', 'css', 'autoprefixer'],
                include: path.join(__dirname, 'src')
            }, {
                test: /\.(png|jpg)$/,
                loader: 'url?limit=1200&name=[hash].[ext]',
                include: path.join(__dirname, 'src')
            }, {
                test: /\.scss$/,
                loaders: ["style", "css", "sass"],
                include: path.join(__dirname, 'src')
            }
        ]
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        }),
        new HtmlWebpackPlugin({
            template: 'src/_index.html',
            filename: 'index.html'
        }),
        new TransferWebpackPlugin([
            {
              from: 'images'
            }
        ], path.resolve(__dirname, "build"))
    ]
};

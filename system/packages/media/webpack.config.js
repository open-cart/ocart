var path = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin'); //installed via npm
const webpack = require('webpack');

module.exports = {
    mode: "production",
    entry: './resources/js/index.js',
    devServer: {
        watchContentBase: true,
        hot: true,
        port: 3000,
        contentBase: path.join(__dirname, 'public'),
        watchOptions: {
            poll: true,
            hotOnly: true,
        }
    },
    output: {
        path: path.resolve(__dirname, '../../../public/tnmedia'),
        filename: 'bundle.js',
        globalObject: "this",
        library: "TnMedia",
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, 'css-loader'],
            },
            // {
            //     test: /\.css$/i,
            //     use: ["style-loader", "css-loader"],
            // },
            {
                test: /\.(js)$/,
                exclude: /node_modules/,
                use: 'babel-loader'
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({filename: 'app.css'}),
        new HtmlWebpackPlugin({
            template: './public/index.html'
        })
    ]
};
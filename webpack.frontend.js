const path = require("path");
const glob = require("glob");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const RemoveEmptyScriptsPlugin = require("webpack-remove-empty-scripts");

const entries = {};

/* JS files */
glob.sync("./assets/dev/js/**/*.js").forEach((file) => {
    const relativePath = path
        .relative("./assets/dev/js", file)
        .replace(/\.js$/, "");

    entries["js/" + relativePath] = path.resolve(__dirname, file);
});

/* CSS files */
glob.sync("./assets/dev/css/**/*.css").forEach((file) => {
    const relativePath = path
        .relative("./assets/dev/css", file)
        .replace(/\.css$/, "");

    entries["css/" + relativePath] = path.resolve(__dirname, file);
});

module.exports = {

    mode: "production",

    entry: entries,

    output: {
        path: path.resolve(__dirname, "assets/dist"),
        filename: "[name].min.js",
        clean: true
    },

    module: {
        rules: [
            {
                test: /\.css$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: "css-loader",
                        options: {
                            url: false
                        }
                    }
                ]
            },

            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ["@babel/preset-env"]
                    }
                }
            }
        ]
    },

    plugins: [

        /* Removes empty JS files generated from CSS entries */
        new RemoveEmptyScriptsPlugin(),

        /* Extract CSS into separate files */
        new MiniCssExtractPlugin({
            filename: "[name].min.css"
        })
    ],

    optimization: {
        minimizer: [
            `...`,
            new CssMinimizerPlugin()
        ]
    },

    stats: "minimal"
};
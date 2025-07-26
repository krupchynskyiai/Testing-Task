const path = require('path');
const glob = require('glob');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

const blockScripts = {};

const files = glob.sync('./template-parts/blocks/**/script.js');
const allBlockScripts = files.map(file => path.resolve(__dirname, file));

module.exports = (env, argv) => ({
  entry: {
    index: './src/js/blocks',
    'blocks/catalog/frontend': './src/js/gutenberg/catalog/frontend',
    slider: './src/js/slider',
    'blocks/all-blocks': allBlockScripts,
    main: './src/js/main'
  },
  output: {
    path: path.resolve(__dirname, 'build'),
    filename: 'js/[name].js',
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: { loader: 'babel-loader' },
      },
      {
        test: /\.scss$/,
        use: ['style-loader', 'css-loader', 'sass-loader'],
      },
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
  plugins: [
    new DependencyExtractionWebpackPlugin({
      injectPolyfill: true,
      combineAssets: true,
    }),
  ],
  resolve: {
    extensions: ['.js', '.jsx'],
  },
  externals: {
  '@wordpress/blocks': ['wp', 'blocks'],
  '@wordpress/element': ['wp', 'element'],
},
  devtool: 'source-map',
  mode: argv.mode || 'development',
});

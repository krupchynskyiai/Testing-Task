const path = require('path');
const DependencyExtractionWebpackPlugin = require('@wordpress/dependency-extraction-webpack-plugin');

module.exports = (env, argv) => ({
  entry: {
    index: './src/js/blocks',
    'blocks/catalog/frontend': './src/js/gutenberg/catalog/frontend',
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

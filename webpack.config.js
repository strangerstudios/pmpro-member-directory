const path = require( 'path' );
const webpack = require( 'webpack' );
const ExtractTextPlugin = require( 'extract-text-webpack-plugin' );

// Set different CSS extraction for editor only and common block styles
const blocksCSSPlugin = new ExtractTextPlugin( {
  filename: './blocks/css/blocks.css',
} );

// Configuration for the ExtractTextPlugin.
const extractConfig = {
  use: [
    { loader: 'raw-loader' },
    {
      loader: 'postcss-loader',
      options: {
        plugins: [ require( 'autoprefixer' ) ],
      },
    },
    {
      loader: 'sass-loader',
      query: {
        outputStyle:
          'production' === process.env.NODE_ENV ? 'compressed' : 'nested',
      },
    },
  ],
};


module.exports = {
  entry: {
   './blocks/profile/block': './blocks/profile/block.js', // Set entry points to same as output points.
   './blocks/directory/block': './blocks/directory/block.js'
  },
  output: {
    path: path.resolve( __dirname ),
    filename: '[name].build.js', // Reference [name].build.js whenever enqueueing.
  },
  watch: 'production' !== process.env.NODE_ENV,
  devtool: 'cheap-eval-source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
        },
      },
      {
        test: /editor\.s?css$/,
        use: blocksCSSPlugin.extract( extractConfig ),
      }
    ],
  },
  plugins: [
    blocksCSSPlugin
  ],
};
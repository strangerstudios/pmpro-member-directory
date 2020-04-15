const path = require('path');
const defaultConfig = require("./node_modules/@wordpress/scripts/config/webpack.config");

module.exports = {
  ...defaultConfig,
	entry: {
		'./blocks/profile/block': './blocks/profile/block.js', // Set entry points to same as output points.
   './blocks/directory/block': './blocks/directory/block.js'
	},
	output: {
		path: path.resolve( __dirname ),
		filename: '[name].build.js', // Reference [name].build.js whenever enqueueing.
	}
}
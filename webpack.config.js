const path = require('path');
const config = require("@wordpress/scripts/config/webpack.config.js");
const CopyPlugin = require("copy-webpack-plugin");
config.entry = {
	"profile/block": path.resolve(
		process.cwd(),
		"blocks",
		"src",
		"profile",
		"block.js"
	),
	"directory/block": path.resolve(
		process.cwd(),
		"blocks",
		"src",
		"directory",
		"block.js"
	)
}

config.output = {
	filename: "[name].build.js",
	path: path.resolve(process.cwd(), "blocks", "dist"),
	clean: false
  };

// Configure webpack to treat blocks/src as the base directory
config.resolve = {
...(config.resolve || {}),
modules: [
	path.resolve(process.cwd(), "blocks", "src"), // Treat this as the base directory
	"node_modules"
]
};

// Copy any .php files to the dist folder
config.plugins.push(
	new CopyPlugin({
		patterns: [
			{
				from: path.resolve(process.cwd(), "blocks", "src", "**", "*.php"),
				to: path.resolve(process.cwd(), "blocks", "dist"),
				context: path.resolve(process.cwd(), "blocks", "src")
			}
		]
	})
);

module.exports = config;
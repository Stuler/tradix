const path = require('path');

module.exports = {
	entry        : __dirname + "/js/app.js",
	mode         : (process.env.NODE_ENV === 'production') ? 'production' : 'development',
	resolve      : {
		extensions: [".ts", ".tsx", ".js", ".json"],
	},
	resolveLoader: {
		modules: [
			'node_modules',
		]
	},
	output       : {
		filename  : 'bundle.js',
		path      : __dirname + "/www/assets",
		publicPath: "/assets/",
	},
	devServer    : {
		static  : {
			directory: path.join(__dirname, '/www/assets'),
		},
		compress: true,
		port    : 8080,
	},
	module       : {
		rules: [
			{
				test: /\.(jpe?g|png|gif|webp|eot|ttf|woff|woff2|svg|)$/i,
				use : [
					{loader: 'url-loader', options: {limit: 1000, name: 'assets/[name].[ext]'}} // assets/[name]-[hash].[ext] // přidá na konec názvu hash, Není pak nutné invalidovat obrázky
				]
			},
			{
				test: /\.css$/,
				use : [
					'style-loader',
					'css-loader'
				]
			},
			{
				test   : /\.tsx?$/,
				exclude: /node_modules/,
				loader : "ts-loader",
			},
			{
				test   : /\.js$/,
				exclude: /node_modules/,
				loader : "babel-loader",
			},
			// spracování source mapy
			{enforce: "pre", test: /\.js$/, loader: "source-map-loader"}
		]
	},
}
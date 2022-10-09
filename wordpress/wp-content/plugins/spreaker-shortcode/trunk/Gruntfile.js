
module.exports = function(grunt) {
	var config = {
		makepot: {
			target: {
				options: {
					domainPath: '/languages',
					mainFile: 'spreaker_shortcode.php',
					potFilename: 'spreaker_shortcode.pot',
					updatePoFiles: true,
					type: 'wp-plugin'
				}
			}
		},
		po2mo: {
			files: {
				src: 'languages/*.po',
				expand: true
			}
		}
	};

	grunt.initConfig(config);
	grunt.loadNpmTasks('grunt-po2mo');
	grunt.loadNpmTasks('grunt-wp-i18n');

	grunt.registerTask(
		'translate',
		'Update POT file',
		['makepot']
	);

	grunt.registerTask(
		'build',
		'Build .po to .mo',
		['po2mo']
	);
};

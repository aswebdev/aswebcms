module.exports = function(grunt) {
  	
	// Project configuration.
	grunt.initConfig({
	  pkg: grunt.file.readJSON('package.json'),
	  uglify: {
		build: {
		  src: 'js/main.js',
		  dest: 'js/main.min.js'
		},
		build: {
		  src: 'ascms/includes/js/scripts.js',
		  dest: 'ascms/includes/js/scripts.min.js'
		}
	  },
	  cssmin: {
		build: {
		  src: 'css/main.css',
		  dest: 'css/main.min.css'
		},
		build: {
		  src: 'css/normalize.css',
		  dest: 'css/normalize.min.css'
		},
		build: {
		  src: 'ascms/includes/css/style.css',
		  dest: 'ascms/includes/css/style.min.css'
		}
	  },
	  imagemin: {
    	dynamic: {                         // Another target
      	files: [{
        	expand: true,                  // Enable dynamic expansion
        	cwd: 'ascms/includes/img/src/',                   // Src matches are relative to this path
        	src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
        	dest: 'ascms/includes/img/dest/'                  // Destination path prefix
      	}]
		}
	  }/*,
	  sass: {
		dist: {
		  files: {
			'ascms/includes/css/style.css': 'ascms/includes/css/style.scss'
		  }
		}
	  }*/
	});
	
	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	
 	// Default task(s).
	grunt.registerTask('default', ['uglify','cssmin','imagemin']);
	
};
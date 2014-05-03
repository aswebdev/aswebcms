module.exports = function(grunt) {
  	
	// Project configuration.
	grunt.initConfig({
	  pkg: grunt.file.readJSON('package.json'),
	  uglify: {
		my_target: {
            files: [{
                expand: true,
                cwd: 'ascms/dev/js',
                src: '*.js',
                dest: 'ascms/dist/js'
            }]
        }
      },
      cssmin: {
		my_target: {
            files: [{
                expand: true,
                cwd: 'ascms/dev/css',
                src: '*.css',
                dest: 'ascms/dist/css'
            }]
        }
      },
      imagemin: {
    	cms : {
      	 files: [{
        	expand: true, 
        	cwd: 'ascms/dev/img/', 
        	src: ['**//*.{png,jpg,gif}'],
        	dest: 'ascms/dist/img/'
      	 }]
		},
        front : {
      	 files: [{
        	expand: true, 
        	cwd: 'dev/img/', 
        	src: ['**//*.{png,jpg,gif}'],
        	dest: 'dist/img/'
      	 }]
		} 
	  }
    /*
    ,
	  imagemin: {
    	dynamic: {                         // Another target
      	files: [{
        	expand: true,                  // Enable dynamic expansion
        	cwd: 'ascms/includes/img/src/',                   // Src matches are relative to this path
        	src: ['**//*.{png,jpg,gif}'],   // Actual patterns to match
        	dest: 'ascms/includes/img/dest/'                  // Destination path prefix
      	}]
		}
	  }
      ,
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
	//grunt.registerTask('default', ['uglify','cssmin','imagemin']);
	grunt.registerTask('default', ['uglify','cssmin','imagemin']);
    
};
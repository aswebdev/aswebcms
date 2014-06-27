module.exports = function( grunt ) {
  	
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
        front : {
      	 files: [{
        	expand: true, 
        	cwd: 'dev/img/', 
        	src: ['**//*.{png,jpg,gif}'],
        	dest: 'dist/img/'
      	 }]
		} 
	  },
        watch: {
         scripts: {
            files: ['dev/img/*.{png,jpg,jpeg,gif}'],
            tasks: ['imagemin'],
            options: {
                spawn: false,
                event: ['added', 'changed']
            }
         }
        }
	});
	
	// Load the plugin that provides the "uglify" task.
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-watch');
    
 	// Default task(s).
	//grunt.registerTask('default', ['uglify','cssmin','imagemin']);
	grunt.registerTask( 'default' , ['uglify','cssmin','imagemin','watch'] );
    
};
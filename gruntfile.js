module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        sass: {
            options: {
                style: 'expanded',
                require: ['susy']
            },
            build: {
                src: 'sass/style.scss',
                dest: 'style.css'
            }
        },
        watch: {
            scripts: {
                files: ['sass/**/*.scss'],
                tasks: ['sass'],
                options: {
                    spawn: false,
                    atBegin: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['sass']);

};
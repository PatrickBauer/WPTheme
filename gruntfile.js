module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        sass: {
            options: {
                style: 'expanded'
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
                    spawn: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['sass']);

};
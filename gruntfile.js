module.exports = function (grunt) {
    grunt.initConfig({
        sass: {
            options: {
                sourceMap: true
            },
            style: {
                files: {
                    'style.css': 'assets/sass/style.scss'
                }
            }
        },
        watch: {
            style: {
                files: ['assets/sass/**/*.scss'],
                tasks: ['sass', 'autoprefixer', 'cssmin'],
                options: {
                    spawn: false,
                    atBegin: true
                }
            },
            scripts: {
                files: ['assets/javascript/**/*.js'],
                tasks: ['uglify'],
                options: {
                    spawn: false,
                    atBegin: true
                }
            }
        },
        autoprefixer: {
            style: {
                src: 'style.css'
            }
        },
        uglify: {
            style: {
                files: {
                    'script.js': ['assets/vendor/jquery/dist/jquery.js', 'assets/javascript/plugins/*.js', 'assets/javascript/custom/*.js']
                }
            }
        },
        cssmin: {
            options: {},
            target: {
                files: {
                    'style.css': ['style.css']
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('default', ['sass', 'autoprefixer', 'uglify', 'cssmin']);
};
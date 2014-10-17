module.exports = function(grunt) {
    // Project configuration.
    grunt.initConfig({
        sass: {
            options: {
                style: 'expanded',
                require: ['susy']
            },
            style: {
                src: 'assets/sass/style.scss',
                dest: 'style.css'
            }
        },
        watch: {
            style: {
                files: ['assets/sass/**/*.scss'],
                tasks: ['sass', 'autoprefixer'],
                options: {
                    spawn: false,
                    atBegin: true
                }
            },
            scripts: {
                files: ['assets/javascript/**/*.js'],
                tasks: ['concat'],
                options: {
                    spawn: false,
                    atBegin: true
                }
            },
            icons: {
                files: ['assets/icons/single/*.png'],
                tasks: ['sprite'],
                options: {
                    spawn: false,
                    atBegin: true
                }
            }
        },
        sprite:{
            all: {
                src: 'assets/icons/single/*.png',
                destImg: 'assets/icons/spritesheet.png',
                imgPath: 'assets/icons/spritesheet.png',
                destCSS: 'assets/sass/_sprite.scss',
                cssFormat: 'scss'
            }
        },
        autoprefixer: {
            style: {
                src: 'style.css'
            }
        },
        concat: {
            javascript: {
                src: ['assets/vendor/jquery/dist/jquery.js', 'assets/javascript/plugins/*.js', 'assets/javascript/custom/*.js'],
                dest: 'assets/javascript/script.js'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-spritesmith');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('default', ['sass']);

};
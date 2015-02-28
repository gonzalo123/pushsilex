module.exports = function (grunt) {

    require('load-grunt-tasks')(grunt);
    require('time-grunt')(grunt);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            js: {
                files: ['Gruntfile.js', 'www/js/**/*.js'],
                tasks: ['jshint'],
                options: {
                    livereload: true
                }
            },

            livereload: {
                options: {
                    livereload: true
                },
                files: [
                    'www/**/*.html',
                    'www/js/**/*.js',
                    'www/css/**/*.css'
                ]
            }
        },

        php: {
            options: {
                port: 8080,
                livereload: true,
                hostname: 'localhost'
            },
            start: {
                options: {
                    open: true,
                    base: 'www/'
                }
            }
        }
    });

    grunt.registerTask('js', ['jshint']);
    grunt.registerTask('serve', ['php:start', 'watch']);
};
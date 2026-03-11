module.exports = function (grunt) {

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    clean: {
      build: ['build']
    },

    copy: {
      build: {
        files: [
          {
            expand: true,
            src: [
              '**',
              '!node_modules/**',
              '!assets/dev/**',
              '!build/**',
              '!Gruntfile.js',
              '!package.json',
              '!package-lock.json',
              '!webpack.frontend.js',
              '!README.md',
            ],
            dest: 'build/<%= pkg.name %>/'
          }
        ]
      }
    },

    compress: {
      main: {
        options: {
          archive: 'build/responsive-addons-for-elementor.zip'
        },
        files: [
          {
            expand: true,
            cwd: 'build/<%= pkg.name %>',
            src: ['**'],
            dest: '<%= pkg.name %>'
          }
        ]
      }
    },

    makepot: {
      target: {
        options: {
          type: 'wp-plugin',
          domainPath: '/languages',
          potFilename: '<%= pkg.name %>.pot',
          mainFile: '<%= pkg.name %>.php',
          exclude: [
            'node_modules/.*',
            'build/.*'
          ]
        }
      }
    },

    shell: {
      build: ['npm run build'].join(' && '),
    },

  });

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');
  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-wp-i18n');

  grunt.registerTask('pot', ['makepot']);
  grunt.registerTask('build', ['clean', 'shell:build', 'pot', 'copy', 'compress']);

};
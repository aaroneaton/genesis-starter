module.exports = (grunt) ->
  @initConfig
    pkg: @file.readJSON('package.json')
    watch:
      files: ['**/**.coffee', '**/*.scss']
      tasks: ['default']
    coffee:
      compile:
        options:
          bare: true
          sourceMap: true
        files:
          'js/scripts.min.js': 'js/src/scripts.coffee'
    compass:
      dist:
        options:
          config: 'config.rb'
    jshint:
      files: [
        'js/scripts.min.js'
      ]
      options:
        globals:
          jQuery: true
          console: true
          module: true
          document: true
    csslint:
      src: ['css/*.css']
    cssmin:
      compress:
        options:
          banner: "/* Don't even attempt to edit this file */"
          report: 'min'
        files:
          'css/screen.min.css': ['css/screen.css']
          'css/ie.min.css': ['css/ie.css']
          'css/print.min.css': ['css/print.css']

  @loadNpmTasks 'grunt-contrib-coffee'
  @loadNpmTasks 'grunt-contrib-compass'
  @loadNpmTasks 'grunt-contrib-jshint'
  @loadNpmTasks 'grunt-contrib-csslint'
  @loadNpmTasks 'grunt-contrib-cssmin'
  @loadNpmTasks 'grunt-contrib-watch'

  @registerTask 'default', ['coffee', 'jshint', 'compass']
  @registerTask 'package', ['default', 'cssmin']

  @event.on 'watch', (action, filepath) =>
    @log.writeln('#{filepath} has #{action}')
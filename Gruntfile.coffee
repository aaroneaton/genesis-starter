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
          'js/scripts.js': 'js/src/*.coffee'
    compass:
      dist:
        options:
          config: 'config.rb'
          specify: ['css/src/screen.scss', 'css/src/ie.scss', 'css/src/print.scss']
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
        force: true
    csslint:
      options:
        'star-property-hack': false
        'duplicate-properties': false
        'unique-headings': false
        'ids': false
        'display-property-grouping': false
        'floats': false
        'outline-none': false
        force: true
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
  @registerTask 'package', ['default', 'cssmin', 'csslint']

  @event.on 'watch', (action, filepath) =>
    @log.writeln('#{filepath} has #{action}')
//
// Dependencies
//
var gulp = require('gulp');

//
// Tasks
//
var phpunit = require('./gulp/phpunit');
var main_styles = require('./gulp/main-styles');
var main_scripts = require('./gulp/main-scripts');
var widget_styles = require('./gulp/widget-styles');
var widget_scripts = require('./gulp/widget-scripts');

//
// Watchers
//
gulp.task('default', [
    'main-styles',
    'main-scripts',
    'widget-scripts',
    'widget-styles',
    // 'phpunit',
]);

gulp.task('phpunit', phpunit);
gulp.task('main-styles', main_styles);
gulp.task('main-scripts', main_scripts);
gulp.task('widget-styles', widget_styles);
gulp.task('widget-scripts', widget_scripts);

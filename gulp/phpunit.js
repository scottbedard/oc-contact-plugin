//
// Dependencies
//
var gulp = require('gulp');
var phpunit = require('gulp-phpunit');

module.exports = function() {
    gulp.src('./phpunit.xml').pipe(phpunit());
};

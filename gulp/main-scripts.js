//
// Dependencies
//
var gulp = require('gulp');
var js = require('./js');

//
// Watch and compile widget styles
//
module.exports = function(obj) {
    gulp.watch('./assets/js/**/*', function(obj) {
        return js('./assets/js/main.js', 'bundle', './assets/compiled');
    });
};

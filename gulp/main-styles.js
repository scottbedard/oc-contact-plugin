//
// Dependencies
//
var gulp = require('gulp');
var scss = require('./scss');

//
// Watch and compile widget styles
//
module.exports = function(obj) {
    gulp.watch('./assets/scss/**/*', function(obj) {
        return scss('./assets/scss/main.scss', 'style', './assets/compiled');
    });
};

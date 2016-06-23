//
// Dependencies
//
var gulp = require('gulp');
var path = require('path');
var scss = require('./scss');

//
// Watch and compile widget styles
//
module.exports = function(obj) {
    gulp.watch(['./widgets/**/*/scss/*', './formwidgets/**/*/scss/*'], function(obj) {
        var file = path.parse(obj.path);
        var output = './' + path.relative('.', file.dir) + '/../compiled';
        return scss(obj.path, file.name, output);
    });
};

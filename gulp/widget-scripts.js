//
// Dependencies
//
var gulp = require('gulp');
var path = require('path');
var js   = require('./js');

//
// Compile widget scripts
//
module.exports = function() {
    gulp.watch([
        './widgets/**/*/js/*',
        './formwidgets/**/*/js/*',
        './components/**/*/js/*'
    ], function(obj) {
        var file = path.parse(obj.path);
        var directory = path.relative('.', file.dir) + './../compiled';

        return js(obj.path, file.name, directory);
    });
};

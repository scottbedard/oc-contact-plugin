//
// Dependencies
//
var gulp        = require('gulp');
var babel       = require('babelify');
var stringify   = require('stringify');
var browserify  = require('browserify');
var notify      = require('gulp-notify');
var uglify      = require('gulp-uglify');
var buffer      = require('vinyl-buffer');
var sourcemaps  = require('gulp-sourcemaps');
var source      = require('vinyl-source-stream');

//
// Compile widget scripts
//
module.exports = function(path, filename, output_dir) {
    browserify(path, { debug: true, extensions: ['.js'] })
        .transform(stringify({
            extensions: ['.htm'],
            minify: true,
            minifier: { extensions: ['.htm'] },
        }))
        .transform(babel)
        .bundle()
        .on('error', notify.onError({
            title: "Compile Error",
            message: "<%= error.message %>"
        }))
        .pipe(source(filename + '.min.js'))
        .pipe(buffer())
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(uglify())
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(output_dir))
        .pipe(notify({ message: 'Javascript compiled!', onLast: true }));
};

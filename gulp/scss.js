//
// Dependencies
//
var gulp            = require('gulp');
var sass            = require('gulp-sass');
var notify          = require('gulp-notify');
var rename          = require('gulp-rename');
var plumber         = require('gulp-plumber');
var minifycss       = require('gulp-minify-css');
var autoprefixer    = require('gulp-autoprefixer');

//
// Compile SCSS
//
module.exports = function(path, filename, output_dir) {
    return gulp.src(path)
        .pipe(plumber({
            errorHandler: notify.onError("Error: <%= error.message %>"),
        }))
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false,
        }))
        .pipe(minifycss())
        .pipe(rename(filename + '.min.css'))
        .pipe(gulp.dest(output_dir))
        .pipe(notify({
            message: "SCSS compiled.",
        }));
};

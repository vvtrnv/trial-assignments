// Include gulp
var gulp = require('gulp'),
  // Include Our Plugins
  less = require('gulp-css'),
  postcss = require('gulp-postcss'),
  autoprefixer = require('autoprefixer');

gulp.task('css', function () {
  gulp
    .src('./css/main.css')
    .pipe(less({ strictMath: true }))
    .pipe(postcss([
      autoprefixer({ browsers: ['> 1%', 'IE 9', 'IE 10']})
    ]))
    .pipe(gulp.dest('./css'));
});

gulp.task('watch', function () {
  gulp.watch('./css/**/*.css', ['css']);
});

gulp.task('default', ['css', 'watch']);

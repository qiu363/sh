var gulp = require('gulp'),
    less = require('gulp-less'),
    cssmin = require('gulp-clean-css');

gulp.task('pro', function () {
  gulp.src(['styles/*.less', 'styles/*.css'])
  .pipe(less())
  .pipe(cssmin())
  .pipe(gulp.dest('styles'));
});

gulp.task('dev', function () {
  gulp.src(['styles/*.less', 'styles/*.css'])
  .pipe(less())
  .pipe(gulp.dest('styles'));
});

gulp.task('devWatch', function () {
  gulp.watch(['styles/*.less', 'styles/*.css'], ['dev']);
});

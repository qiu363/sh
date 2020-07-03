var gulp = require('gulp'),
    concat = require('gulp-concat'),
    preprocess = require("gulp-preprocess"),
    prefix = require('gulp-prefix'),
    autoprefixer = require('gulp-autoprefixer'),
    rev = require('gulp-rev'),
    revCollector = require('gulp-rev-collector'),
    less = require('gulp-less'),
    cssmin = require('gulp-clean-css'),
    imgmin = require('gulp-imagemin'),
    uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint'),
    imgbase64 = require('gulp-base64'),
    clean = require('gulp-clean')
    cdnizer = require('gulp-cdnizer'),
    webserver = require('gulp-webserver'),
    revReplace = require("gulp-rev-replace");

var config = {
  cdn: './static' // CDN地址
};

gulp.task('cleanCss', function () {
  return gulp.src('./src/css')
    .pipe(clean());
});

gulp.task('clean', function () {
  return gulp.src('./dist/*')
    .pipe(clean());
});

gulp.task('imgMin', function () {
  return gulp.src('./src/img/**/*')
    .pipe(imgmin())
    .pipe(rev())
    .pipe(gulp.dest('./dist/static/img/'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('./dist/sourceMap/img'));
});

gulp.task('less', function () {
  return gulp.src('./src/less/**/*.{css,less}')
    .pipe(autoprefixer())
    .pipe(less())
    .pipe(imgbase64({
      baseDir: __dirname + '/src',
      extensions: ['png', 'gif', /\.jpg#inline$/i],
      maxImageSize: 8 * 1024,
      debug: false
    }))
    .pipe(gulp.dest('./src/css/'));
});

gulp.task('cssRev', ['imgMin', 'less'], function () {
  var manifest = gulp.src('./dist/sourceMap/**/*.json');
  return gulp.src('./src/css/**/*.css')
    .pipe(revReplace({manifest: manifest}))
    .pipe(cdnizer({
      defaultCDNBase: config.cdn,
      files: ['**/*.{gif,png,jpg,jpeg}']
    }))
    .pipe(cssmin())
    .pipe(rev())
    .pipe(gulp.dest('./dist/static/css/'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('./dist/sourceMap/css'));
});

gulp.task('jsMin', function () {
  return gulp.src('./src/js/**/*')
    .pipe(preprocess({
      context: {
        NODE_ENV: "production",
        DEBUG: false
      }
    }))
    .pipe(jshint())
    .pipe(rev())
    .pipe(uglify())
    .pipe(gulp.dest('./dist/static/js/'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('./dist/sourceMap/js'));
});

gulp.task('dealHtml', ['cssRev', 'jsMin'], function () {
  return gulp.src(['./dist/sourceMap/**/*.json', './src/html/**/*'])
    .pipe(revCollector())
    .pipe(prefix(config.cdn, null))
    .pipe(gulp.dest('./dist'));
});

gulp.task('pro', ['clean'], function(){
    gulp.start('dealHtml');
});

// 测试
gulp.task('jsMinTest', function () {
  return gulp.src('./src/js/**/*')
    .pipe(preprocess({
      context: {
        NODE_ENV: "testing",
        DEBUG: false
      }
    }))
    .pipe(jshint())
    .pipe(rev())
    .pipe(uglify())
    .pipe(gulp.dest('./dist/static/js/'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('./dist/sourceMap/js'));
});

gulp.task('dealHtmlTest', ['cssRev', 'jsMinTest'], function () {
  return gulp.src(['./dist/sourceMap/**/*.json', './src/html/**/*'])
    .pipe(revCollector())
    .pipe(prefix(config.cdn, null))
    .pipe(gulp.dest('./dist'));
});

gulp.task('test', ['clean'], function(){
    gulp.start('dealHtmlTest');
});

// 开发
var devConfig = {
  cdn: '/dev/static', // 测试地址
  host: 'localhost',
  prot: '8000'
};

gulp.task('devImgMin', function () {
  return gulp.src('./src/img/**/*')
    .pipe(gulp.dest('./dev/static/img/'));
});

gulp.task('devCssMin', function () {
  return gulp.src('./src/less/**/*.{css,less}')
    .pipe(autoprefixer())
    .pipe(less())
    .pipe(imgbase64({
      baseDir: __dirname + '/src',
      extensions: ['png', 'gif', /\.jpg#inline$/i],
      maxImageSize: 8 * 1024,
      debug: false
    }))
    .pipe(cdnizer({
      defaultCDNBase: devConfig.cdn,
      files: ['**/*.{gif,png,jpg,jpeg}']
    }))
    .pipe(gulp.dest('./dev/static/css/'));
});

gulp.task('devJsMin', function () {
  return gulp.src('./src/js/**/*')
    .pipe(preprocess({
      context: {
        NODE_ENV: "development",
        DEBUG: true
      }
    }))
    .pipe(gulp.dest('./dev/static/js/'));
});

gulp.task('devDealHtml', function () {
  return gulp.src('./src/html/**/*')
    .pipe(prefix(devConfig.cdn, null))
    .pipe(gulp.dest('./dev/'));
});

gulp.task('webserver', function () {
  gulp.src('./')
    .pipe(webserver({
      livereload: true,
      directoryListing: true,
      open: true
    }));
});

gulp.task('dev', function () {
  gulp.start('webserver');
  gulp.watch([
    './src/img/**/*',
    './src/less/**/*.{css,less}',
    './src/js/**/*',
    './src/html/**/*'
  ], [
    'devImgMin',
    'devJsMin',
    'devCssMin',
    'devDealHtml'
  ]);
});

var gulp = require('gulp');
var babel = require('gulp-babel');
var gulpif = require('gulp-if');
var gutil = require('gulp-util');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var nano = require("gulp-cssnano");
var sass = require("gulp-sass");
//var merge = require("merge-stream");

var dest = './web/build/';
var isProd = gutil.env.env == 'prod';

gulp.task('js', function () {
    return gulp.src([
       'node_modules/jquery/dist/jquery.min.js',
       'node_modules/bootstrap/dist/js/bootstrap.min.js',
       'node_modules/vue/dist/vue' + (isProd ? '.min.js' : '.js'),
    ])
    .pipe(babel())
    .pipe(gulpif(isProd,uglify()))
    .pipe(concat('frontend.js'))
    .pipe(gulp.dest(dest));
});

gulp.task('css', function () {
    return gulp.src([
       'node_modules/bootstrap/dist/css/bootstrap.min.css',
       'app/Resources/assets/css/**/*.{css,scss}'
    ])
    .pipe(sass())
    .pipe(concat('frontend.css'))
    .pipe(gulpif(isProd, nano()))
    .pipe(gulp.dest(dest));
    //return merge(css);
});

gulp.task('css:fonts', function () {
    return gulp.src([
       'node_modules/bootstrap/fonts/*',
    ])
    .pipe(gulp.dest('./web/fonts/'));
    //return merge(css);
});

gulp.task('watch', function(){
    gulp.watch(['**/*.{css,scss}'], { cwd: './app/Resources/assets/'}, ['css']);
    //gulp.watch(['**/*.{css,scss}'], { cwd: './web/css/'}, ['css']);
    gulp.watch(['**/*.js'], { cwd: './app/Resources/assets/'}, ['js']);
    //gulp.watch(['**/*.js'], { cwd: './web/js/'}, ['js']);
});

gulp.task('default', ['css', 'css:fonts', 'js']);
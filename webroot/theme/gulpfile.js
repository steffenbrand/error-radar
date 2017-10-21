var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var del = require('del');
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');
var replace = require('gulp-replace');
var runSequence = require('run-sequence');

gulp.task('sass', function () {
    gulp.src([
        './node_modules/propellerkit/dist/css/bootstrap.min.css',
        './node_modules/propellerkit/dist/css/propeller.min.css',
        './dist/fonts/material-design-icons/material-icons.css',
        './assets/sass/main.scss'
    ])
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('main.css'))
        .pipe(cleanCSS({'keepSpecialComments': 0}))
        .pipe(gulp.dest('./dist/css/'));
});

gulp.task('js', function () {
    gulp.src([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/propellerkit/dist/js/bootstrap.min.js',
        './node_modules/propellerkit/dist/js/propeller.min.js',
        './assets/js/app.js'
    ])
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist/js/'));
});

gulp.task('images', function () {
    gulp.src([
        './assets/images/**/*.*'
    ])
        .pipe(gulp.dest('./dist/images/'));
});

gulp.task('fonts', function () {
    gulp.src([
        './node_modules/propellerkit/dist/fonts/roboto/*.*'
    ])
        .pipe(gulp.dest('./dist/fonts/roboto/'));
    gulp.src([
        './node_modules/material-design-icons/iconfont/MaterialIcons-Regular.*'
    ])
        .pipe(gulp.dest('./dist/fonts/material-design-icons/'));
    gulp.src([
        './node_modules/material-design-icons/iconfont/material-icons.css'
    ])
        .pipe(replace('url(MaterialIcons-Regular', 'url(../fonts/material-design-icons/MaterialIcons-Regular'))
        .pipe(gulp.dest('./dist/fonts/material-design-icons/'));
});

gulp.task('clean', function () {
    return del([
        './dist/**/*'
    ]);
});

gulp.task('build', function() {
    runSequence(
        ['clean'],
        ['images', 'fonts'],
        ['sass', 'js']
    );
});

gulp.task('default', ['build']);
/* eslint-disable */
import gulp from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import concat from 'gulp-concat';
import uglify_es from 'gulp-uglify-es';
import rename from 'gulp-rename';
import autoprefixer from 'gulp-autoprefixer';
import javascriptObfuscator from 'gulp-javascript-obfuscator';

const { src, dest } = gulp;
const sass = gulpSass(dartSass);
const uglify = uglify_es.default;

//****************************************************
// Global Styles
//****************************************************
gulp.task('styles', function () {
    return gulp.src(['./assets/scss/**/*.scss'])
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./dist/css'));
});

/* __Start Styles Watchers__ */
gulp.task('watch-styles', function () {
    gulp.watch(['assets/scss/**/*.scss'], gulp.series('styles'));
});

//****************************************************
// Global Scripts
//****************************************************
gulp.task('scripts', function () {
    return gulp.src(['./assets/js/**/*.js',])
        .pipe(uglify()).on('error', () => {console.error("error"); process.exit(1)})
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('dist/js'));
});

/* __Start Scripts Watchers__ */
gulp.task('watch-scripts', function () {
    gulp.watch(['assets/js/**/*.js',], gulp.series('scripts'));
});
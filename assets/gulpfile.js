const sass = require('gulp-sass')(require('sass'));
const { src, dest, watch, parallel, series } = require('gulp');
const concat = require('gulp-concat');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify-es').default;
const autoprefixer = require('gulp-autoprefixer');
const del = require('del');

function cleanDist() {
    return del('dist');
}

function scripts() {
    return src([
        'src/js/main.js',
    ])
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(dest('src/js'))
        .pipe(browserSync.stream())
}


function styles() {
    return src([
        'src/sass/**/*.scss',
        'src/sass/main.scss'
    ])
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(concat('main.min.css'))
        .pipe(autoprefixer({
            overrideBrowserslist: ['last 5 versions', 'ie 11', 'Android >= 4.1', 'Safari >= 8', 'iOS >= 8'],
            grid: true
        }))
        .pipe(dest('src/css'))
        .pipe(browserSync.stream())
}

function browsersync() {
    browserSync.init({
        server: {
            baseDir: ['src', 'src/html'],
            index: 'html/index.html'
        },
        port: 4000
    });
}

function build() {
    return src([
        'src/css/main.min.css',
        'src/fonts/**/*',
        'src/js/main.min.js',
    ], { base: 'src' })
        .pipe(dest('dist'))
}

function watching() {
    watch(['src/sass/**/*.scss'], styles)
    watch(['src/js/main.js'], scripts)
    watch(['src/html/**/*.html']).on('change', browserSync.reload);
}

exports.styles = styles;
exports.watching = watching
exports.browsersync = browsersync
exports.scripts = scripts
exports.cleanDist = cleanDist

exports.build = series(cleanDist, build)
exports.start = parallel(styles, scripts, browsersync, watching)
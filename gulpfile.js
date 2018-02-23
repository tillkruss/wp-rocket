var gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var browserify = require('browserify');
var watchify = require('watchify');
var babel = require('babelify');
var sass = require('gulp-sass');


/* Task to compile sass */
gulp.task('sass', function () {
  return gulp.src('./src/scss/main.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('assets/css'));
});

 /* Task to watch sass changes */
gulp.task('sass:watch', function () {
  gulp.watch('./src/scss/main.scss', ['sass']);
});


/* Task to compile JS */
function compile(watch) {
    var bundler = watchify(browserify('./src/js/global/app.js', {debug: true}).transform(babel));

    function rebundle() {
        bundler.bundle()
                .on('error', function (err) {
                    console.error(err);
                    this.emit('end');
                })
                .pipe(source('app.js'))
                .pipe(buffer())
                .pipe(sourcemaps.init({loadMaps: true}))
                .pipe(sourcemaps.write('./'))
                .pipe(gulp.dest('assets/js'));
    }

    if (watch) {
        bundler.on('update', function () {
            console.log('-> bundling...');
            rebundle();
        });
    }

    rebundle();
}

function watch() {
    return compile(true);
};

gulp.task('build', function () {
    return compile();
});
gulp.task('watch', function () {
    return watch();
});

gulp.task('default', ['watch', 'sass', 'sass:watch']);

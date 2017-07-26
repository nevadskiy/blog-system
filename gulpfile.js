var gulp 		= require('gulp'),
	sass 		= require('gulp-sass'),
	browserSync = require('browser-sync'),
	plumber = require('gulp-plumber'),

	concat = require('gulp-concat'),
	cleanCSS = require('gulp-clean-css'),
	rename = require("gulp-rename"),
	autoprefixer = require('gulp-autoprefixer'),
	uncss = require('gulp-uncss');

gulp.task('sass', function() {
//	return gulp.src('app/sass/**/*.+(scss|sass)')
		gulp.src('public/sass/**/*.+(scss|sass)')
		    .pipe(plumber())
		.pipe(sass())
		.pipe(gulp.dest('public/css'))
		.pipe(browserSync.reload({stream: true}))
});

 gulp.task('concatting', function() {
  return gulp.src('public/css/*.css')
     .pipe(concat('style.css'))
     .pipe(gulp.dest('public/css'));
 });
 
gulp.task('minify-css', function() {
   return gulp.src('app/css/*.css')
     .pipe(cleanCSS({compatibility: 'ie8'}))
     .pipe(gulp.dest('app/css/minified'));
 });

gulp.task('rename', function() {
  return gulp.src("app/css/main.css")
 .pipe(rename("main.min.css"))
 .pipe(gulp.dest("app/css/"));
});
 
gulp.task('prefixer', function() {
    gulp.src('app/css/*.css')
        .pipe(autoprefixer({
            browsers: ['last 10 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('app/css'))
});

gulp.task('uncss', function () {
    return gulp.src('app/css/main.css')
        .pipe(uncss({
            html: ['index.html', 'app/**/*.html']
        }))
        .pipe(gulp.dest('app/css/uncssed.css'));
});//Отсечка ненужных стилей с ЦСС, например, с библиотеки бутстрапа.

gulp.task('browser-sync', function() {
	browserSync({
		proxy: 'my-blog'
	});
});

gulp.task('watch', ['browser-sync', 'sass'], function() {
	gulp.watch('public/sass/**/*.+(scss|sass)', ['sass']);
	gulp.watch('app/**/*.php', browserSync.reload);
	gulp.watch('public/js/**/*.js', browserSync.reload);
});

// Default Task
gulp.task('default', ['watch']);

 

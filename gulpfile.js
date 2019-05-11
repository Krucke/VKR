var gulp = require('gulp');
var sass = require('gulp-sass');
var livereload = require('gulp-livereload');

gulp.task("reload-css",function(){
  gulp.src('./web/scss/master.scss')
  .pipe(sass().on('error', sass.logError))
  .pipe(gulp.dest('./web/css'))
  .pipe(livereload());
})

gulp.task("default",function(){
  livereload.listen();
  gulp.watch('./web/scss/master.scss',['reload-css']);
})

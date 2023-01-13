const gulp = require('gulp');
const zip = require('gulp-zip');
const rimraf = require('rimraf');
const replace = require('gulp-replace');
const {version} = require('./package.json');
const exec = require('child_process').exec;

async function clean(cb) {
  await rimraf(['dist/', 'build/', 'tmp/', 'svn/trunk']);
  cb();
}

async function cleanUp(cb) {
  await rimraf('tmp/',)
  cb();
}

function copyToTrunk() {
  return gulp.src(['./tmp/**']).pipe(gulp.dest('svn/trunk'));
}

function createZip() {
  return gulp.src(['./tmp/**']).
      pipe(zip('visual-user-description-editor.zip', {compress: false})).
      pipe(gulp.dest('dist'));
}

function copy() {
  return gulp.src([
    './**',
    '!./visual-user-description-editor.php',
    '!./readme.txt',
    '!./package.json',
    '!./package-lock.json',
    '!./.gitignore',
    '!./svn/**',
    '!./.git/**',
    '!./.github/**',
    '!./node_modules/**',
    '!./src/**',
    '!./dist/**',
    '!./tmp/**',
    '!./gulpfile.js',
    '!./.gitignore']).pipe(gulp.dest('tmp'));
}

function replaceVersion() {
  return gulp.src(['visual-user-description-editor.php', 'readme.txt']).
      pipe(replace(/{{version}}/g, `${version}`)).
      pipe(gulp.dest('tmp'));
}

function js(cb) {
  exec('wp-scripts build', function(err, stdout, stderr) {
    console.log(stdout);
    console.log(stderr);
    cb(err);
  });
}

exports.build = gulp.series(clean, js, copy, replaceVersion, createZip, copyToTrunk, cleanUp);

exports.clean = clean;

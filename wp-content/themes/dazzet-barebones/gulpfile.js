
// Importqamos los plugins de gulp necesarios
var gulp      = require('gulp'),
    sass      = require('gulp-sass'),
    rucksack  = require('gulp-rucksack'),
    plumber   = require('gulp-plumber'),
    rsync     = require('gulp-rsync'),
    bs        = require('browser-sync');

  var insDir = '/var/www/wp/wp-content/themes/dazzet-barebones',
    sshServer = '45.55.194.5',
    sshUser = 'mario.yepes',
    domain    = 'wp.dev',
    themeDir  = '.';

gulp.task('scss', function() {

  gulp.src('scss/*.scss')
    .pipe(plumber())
    .pipe(sass({ includePaths: [
      'node_modules/bootstrap-sass/assets/stylesheets'
    ]}))
    .pipe(rucksack({ autoprefixer: true }))
    .pipe(gulp.dest( themeDir ))
    .pipe(bs.stream());

});

/**
 * Vigila el directrio scss y compila los archivos si hay un cambio
 */
gulp.task('watch', ['scss'], function() {
  bs.init({
    proxy: domain,
    port: 8080
  });
  gulp.watch(themeDir + '/scss/**/*.scss', ['scss']);
  // gulp.watch(themeDir + '/js/**/*.js', ['js'], bs.reload);
});

gulp.task('watch-remote', ['scss'], function() {

  let url = 'https://google.com';

  for ( let i = 0; i < process.argv.length; i++) {
    if (process.argv[i] == '--url') {
      url = process.argv[i+1];
      break;
    }
  }
  if (url == 'https://google.com') {
    console.log('****USO****: gulp watch-remote --url http://dazzet.co');
    return;
  }

  bs({
    proxy: url,
    files: ['*.css'],
    serveStatic: ['.', 'js'],
    rewriteRules: [
      {
        match: new RegExp('/wp-content/themes/dazzet-barebones/barebones.css'),
        fn: function() { return '/barebones.css'; }
      }
    ]
  });

  gulp.watch(themeDir + '/scss/**/*.scss', ['scss']);
});


/**
 * Copia en el servidor de desarrollo los archivos del tema que han cambiado
 */
gulp.task('rsync', ['scss'], function() {
  return gulp.src(themeDir )
    .pipe(rsync({
      root: themeDir + '/',
      destination: insDir + '/',
      hostname: sshServer,
      recursive: true,
      compress: true,
      username: sshUser,
      exclude: ['*scss', '.DS_Store', 'README.md', '.git', 'node_modules', 'yarn.lock', '.gitignore', 'package-lock.json']
    }))
});


// vim: ts=2 sw=2 sts=2  sr et

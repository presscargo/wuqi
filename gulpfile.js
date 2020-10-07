var gulp          = require('gulp');
var autoprefixer  = require('gulp-autoprefixer');
var babel         = require('gulp-babel');
var cleanCSS      = require('gulp-clean-css');
var concat        = require('gulp-concat');
var header        = require('gulp-header');
var minimist      = require('minimist');
var rename        = require('gulp-rename');
var replace       = require('gulp-replace');
var notify        = require('gulp-notify');
var sass          = require('gulp-sass');
var sourcemaps    = require('gulp-sourcemaps');
var uglify        = require('gulp-uglify');
var browserSync   = require('browser-sync');
var reload        = browserSync.reload;

// File sets to use for search and replace
var searchFiles = {
	// Files that have our current version output
	version: [
		'README.md',
		'package.json',
		'assets/scss/style.scss',
		'style.css'
	],
	// Files we never want to edit
	exclude: [
		'!./node_modules/**'
	]
};

// Save passed parameters to use in gulp tasks
var options = minimist(process.argv.slice(2));

// Browser sync
// =========================================================
gulp.task('browser-sync', function() {
	var files = [
		'**/*.php',
		'**/*.scss'
	];

	browserSync.init(files, {
		proxy: 'https://themes.local/'
	});
});

// Compile our stylesheets
// =========================================================
gulp.task('styles', function() {
	gulp.src('./src/scss/editor-style.scss')
		.pipe(sass({
			outputStyle: 'expanded'
		}))
		.pipe(gulp.dest('./assets/css/'));
	gulp.src('./src/scss/style.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'expanded'
		}).on('error', notify.onError(function(error) {
			return "Error: " + error.message;
		})))
		.pipe(gulp.dest('./assets/css/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(cleanCSS({
			keepSpecialComments:0
		}))
		.pipe(header())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/css/'))
		.pipe(reload({stream:true}))
		.pipe(notify({message: "Styles task complete!"}));
});

// Compile our scripts
// =========================================================
gulp.task('scripts', function() {
	return gulp.src('src/js/**/*.js')
		.pipe(concat('app.js'))
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(gulp.dest('./assets/js/'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify()
			.on('error', notify.onError(function(error) {
				return "Error: " + error.message;
			}))
		)
		.pipe(babel({
			presets: ['@babel/env']
		}))
		.pipe(gulp.dest('./assets/js/'))
		.pipe(reload({stream:true}))
		.pipe(notify({message: "Scripts task complete!"}));
});

// Watch function
// =========================================================
gulp.task('watch', ['styles', 'scripts'], function() {
	gulp.watch('./src/scss/**/*.scss', ['styles']);
	gulp.watch('./src/js/**/*.js', ['scripts']);
})

// Build an updated package
// =========================================================
gulp.task('build', ['styles', 'scripts']);

// Update versions
// =========================================================
gulp.task('version', function() {
	// Check if the exclude array exists and pass it or an empty array into `src`
	var src = typeof searchFiles['exclude'] != "undefined" ? searchFiles['exclude'] : [];

	// Check if all required parameters have been set
	if ((options.s == undefined) || (options.r == undefined) || (options.f == undefined)) {
		// If any are missing, output a usage error
		console.error('USAGE: gulp replace -s <SEARCH> -r <REPLACE> -f <FILES>');
	} else {
		// Check if the passed files is the key of an existing searchFiles array
		if (searchFiles[options.f] != undefined) {
			// If so, combine it with our excludes array
			src = searchFiles[options.f].concat(src);
		} else {
			// If not, create an array using the passed string (split by `,`)
			// and combine it with excludes array
			src = String(options.f)
			.replace(/\s+/g, '')
			.split(',')
			.concat(src);
		}

		// Example gulp version -s 1.0.0 -r 1.0.1 -f version
		// Run our task!
		return gulp.src(src, { base: './' })
			.pipe(replace(String(options.s), String(options.r)))
			.pipe(gulp.dest('./'));
	}
});

// Search and replace
// =========================================================
gulp.task('replace', function() {
	return gulp.src(['**', '!./node_modules/**', '!./gulpfile.js', '!./library/'], { base: './' })
		.pipe(replace('anchor', 'wuqi')) // text domains, variables
		.pipe(replace('AnchorWP', 'Wuqi')) // class names
		.pipe(replace('Anchor', 'Wuqi')) // text
		.pipe(replace('ANCHORWP', 'WUQI')) // constants
		.pipe(gulp.dest('./'));
});

// Default task
// =========================================================
gulp.task('default', ['watch', 'browser-sync']);

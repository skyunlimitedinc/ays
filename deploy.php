<?php
namespace Deployer;

/** @noinspection PhpIncludeInspection */
require 'recipe/laravel.php';

// Project name
set('application', 'americanyachtsupply.com');

// Project repository
set('repository', 'git@github.com:SturmB/ays.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Overrides
set('default_stage', 'beta');
//set('http_user', 'chris');
set('http_group', 'www-data');

// Hosts

host('skyubuntu')
    ->stage('beta')
    ->set('deploy_path', '/var/www/{{application}}');

host('skyweb')
    ->stage('prod')
    ->set('deploy_path', '/var/www/{{application}}');

host('do-ays')
    ->stage('prod')
    ->set('deploy_path', '/var/www/html');

host('159.203.72.159')
    ->stage('prod')
    ->set('deploy_path', '/var/www/html');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// Copy over the "fixed" Voyager vendor files.
task('fix:voyager', function () {
    upload('vendor/tcg/', '{{release_path}}/vendor/tcg');
});
// Reload php-fpm.
task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php7.4-fpm reload');
});
// Change the group to www-data.
task('regroup', function () {
    run('sudo /bin/chgrp -R {{http_group}} {{deploy_path}}');
});

// Combine the above tasks into one.
task('post-deploy', ['reload:php-fpm', 'regroup']);

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

// Execute a few other tasks.
after('deploy:vendors', 'fix:voyager');
after('cleanup', 'post-deploy');

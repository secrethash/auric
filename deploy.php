<?php

namespace Deployer;

// require 'recipe/cloudflare.php';
require 'recipe/laravel.php';

// Project name
set('application', 'auric');

// Project repository
set('repository', 'git@github.com:secrethash/auric.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', ['public/storage']);

// Writable dirs by web server
add('writable_dirs', []);

// Cloudflare Configuration
// set('cloudflare', [
//     "service_key" => "",
//     "api_key" => "",
//     "email" => "",
//     "domain" => "auricshops.com",
// ]);

// Hosts
set('default_stage', 'alpha');

host('auric_stable')
    ->stage('stable')
    ->set('deploy_path', '~/sites/stable');

host('auric')
    ->stage('alpha')
    ->set('deploy_path', '~/sites/alpha');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// task('clear:memcache', function () {
//     run('flush_memca');
// });

task('app:optimize', function() {
    run('cd ~/sites/alpha/current');
    run('php artisan view:clear');
    run('php artisan route:clear');
    run('php artisan config:clear');
    run('php artisan cache:clear');
    run('php artisan route:cache');
    run('php artisan config:cache');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
// after('artisan:migrate', 'app:optimize');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

task('project:art', function() {
    write("


    ______                 _              _
    | ___ \               (_)            | |
    | |_/ / _ __   ___     _   ___   ___ | |_
    |  __/ | '__| / _ \   | | / _ \ / __|| __|
    | |    | |   | (_) |  | ||  __/| (__ | |_
    \_|    |_|    \___/   | | \___| \___| \__|
                         _/ |
                        |__/
      ___                _
     / _ \              (_)
    / /_\ \ _   _  _ __  _   ___
    |  _  || | | || '__|| | / __|
    | | | || |_| || |   | || (__
    \_| |_/ \__,_||_|   |_| \___|




    ");
});

before('deploy:prepare', 'project:art');

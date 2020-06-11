<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'alpha_auric');

// Project repository
set('repository', 'git@github.com:secrethash/auric.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env.deploy']);
add('shared_dirs', ['public/storage']);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('auric')
    ->stage('alpha')
    ->set('deploy_path', '~/sites/alpha');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('artisan:optimize', function() {});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');


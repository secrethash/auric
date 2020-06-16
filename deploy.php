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

// task('clear:memcache', function () {
//     run('flush_memca');
// });

// task('artisan:optimize', function() {});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
// after('cleanup', 'clear:memcache');

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

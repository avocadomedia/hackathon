<?php

namespace Deployer;

require 'recipe/laravel.php';
require 'contrib/rsync.php';

set('application', 'hackathon');
set('git_tty', true);

add('shared_files', []);
add('shared_dirs', []);

desc('Composer install');
task('composer:install', function () {
    run('cd {{ release_path }}; composer install --ignore-platform-reqs --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts;');
});

// Tasks
set('rsync', [
    'exclude' => [
        '*',
    ],
    'exclude-file' => false,
    'include' => [
        '/public/**',
        '/public',
    ],
    'include-file' => false,
    'filter' => [],
    'filter-file' => false,
    'filter-perdir' => false,
    'flags' => 'rz',
    'options' => ['delete', 'delete-after', 'force'],
    'timeout' => 3600,
]);

set('repository', 'git@github.com:avocadomedia/hackathon.git');

// Hosts
host('production')
    ->set('hostname', '134.209.81.241')
    ->set('ssh_arguments', ['-o PubkeyAcceptedAlgorithms=+ssh-rsa', '-o StrictHostKeyChecking=no', '-o KexAlgorithms=+diffie-hellman-group1-sha1', '-o PubkeyAcceptedKeyTypes=rsa-sha2-256', '-o HostkeyAlgorithms=+ssh-dss'])
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('labels', ['stage' => 'production'])
    ->set('remote_user', 'root')
    ->set('http_user', 'root')
    ->set('writable_mode', 'chmod')
    ->set('rsync_src', __DIR__)
    ->set('rsync_dest', '/var/www/laravel/release')
    ->set('deploy_path', '/var/www/laravel');


task('deploy', [
    'deploy:prepare',
    'rsync',
    'composer:install',
    'artisan:storage:link',
    'artisan:config:cache',
    'artisan:cache:clear',
    'artisan:route:cache',
    'artisan:view:cache',
    'artisan:event:cache',
    'artisan:migrate',
    'deploy:publish',
]);

after('deploy:failed', 'deploy:unlock');

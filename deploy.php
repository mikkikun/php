<?php

namespace Deployer;

require 'recipe/laravel.php';

// プロジェクト名（自分のプロジェクト名を設定）
set('application', 'php');

// [Optional] gitcloneにttyを割り当てる。デフォルト値はfalse。
set('git_tty', false);

// デプロイ間の共有ファイル/ディレクトリ
add('shared_files', []);
add('shared_dirs', []);

// Webサーバーによる書き込み可能なディレクトリ
add('writable_dirs', []);
set('allow_anonymous_stats', false);

set('repository', 'https://github.com/mikkikun/php.git');
set('composer_options', 'install --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');
// host('cardmatch.click')
host('18.183.226.34')
    // ->set('stage', 'cardmatch')
    ->set('remote_user', 'ec2-user')
    // ->set('identity_file', '/root/.ssh/aws-and-infra-ssh-key.pem')
    ->set('identity_file', '~/Desktop/aws-and-infra-ssh-key.pem')
    ->set('deploy_path', '/var/www/');

task('build', function () {
    ('cd {{release_path}} && build');
});

// [Optional] デプロイが失敗した場合、自動的にロックが解除される。
after('deploy:failed', 'deploy:unlock');

// シンボリックリンクの新しいリリースの前にデータベースを移行する。
before('deploy:symlink', 'artisan:migrate');

task('deploy:vendors', function () {
  run('cd {{release_path}} && {{bin/composer}} install --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');
})->desc('Installing vendors');

task('deploy:update_composer', function () {
  cd('{{release_path}}');
  run('composer update --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader');
})->desc('Update composer packages');

task('deploy:change_php_version', function () {
  run('sudo update-alternatives --set php /usr/bin/php7.4');
})->desc('Change PHP version');
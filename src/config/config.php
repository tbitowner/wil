<?php

$APP_ROOT = __DIR__;

$migration = __DIR__.'/migration.php';

return [
 


    'app.app_root' => $APP_ROOT,
    'app.migration' => $migration,

    //replace email to for debugging/updates
    //$config['app.email_to'] = 'user@example.com

    //'monolog.name' => 'yourappname',
    //'monolog.level' => \Monolog\Logger::WARNING,
    //'monolog.logfile' => $APP_ROOT.'/../logs/app.log',

    //'app.static_root_fs' => \HE\Util::joinPaths($APP_ROOT, '..', 'web', 'static'),
    'app.static_root_web' => website_url() . '/../assets/%s',
    'app.static_root_web_bootstrap' => website_url() . '/../assets/lib/bootstrap-3.1.1-dist/%s',
    'app.static_root_web_articulate' => website_url() . '/../assets/lib/articulate/%s',
    'app.static_root_web_agency' => website_url() . '/../assets/lib/agency/%s',
    'app.static_root_web_velocity' => website_url() . '/../assets/lib/velocity/%s',
    'app.wp_assets' => website_url() . '/../dashboard/wp-content/uploads/%s',
    'app.static_root_assets' => $APP_ROOT . '/../../../wil_dashboard/wp-content/uploads/',

    /*
    $config['file_repos.options'] = array(
        'photos'=>array('class_name'=>'\\YourAppName\\UserFileRepository', 'fs_root'=>\VURIA\Util::joinPaths(__DIR__, '..', 'data', 'repo', 'photos'), 'web_root'=>'/repo/photos/'),
        'thumbs'=>array('class_name'=>'\\YourAppName\\ThumbnailerRepository', 'fs_root'=>\VURIA\Util::joinPaths(__DIR__, '..', 'data', 'repo', 'thumbs'), 'web_root'=>'/repo/thumbs')
    );
    */

    'app.secret_key' => md5(time()),

    'swiftmailer.options' => array(
        'host' => 'smtp.gmail.com',
        'port' => '465',
        'username' => 'adam.david.rodriguez@gmail.com',
        'password' => '628749636MatrixNeo!',
        'encryption' => 'ssl',
        'auth_model' => ''
    ),

 

    'app.email_from' => 'darol@techbaseit.com',
    'app.email_from_name' => 'Darol Lucas'

    

];

if(file_exists(__DIR__.'/config.local.php')) {
        require __DIR__.'/config.local.php';
    }
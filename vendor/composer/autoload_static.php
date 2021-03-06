<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite3635c1f365bfde9467e9315b0a1deff
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\PHPMailer\\' => 14,
            'App\\Inteface\\' => 13,
            'App\\Config\\Query\\' => 17,
            'App\\Config\\' => 11,
            'App\\BaseView\\' => 13,
            'App\\BaseTest\\' => 13,
            'App\\BaseModel\\' => 14,
            'App\\BaseLib\\' => 12,
            'App\\BaseController\\' => 19,
            'App\\Action\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/PHPMailer',
        ),
        'App\\Inteface\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/interfaces',
        ),
        'App\\Config\\Query\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/config/query',
        ),
        'App\\Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/config',
        ),
        'App\\BaseView\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/views',
        ),
        'App\\BaseTest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/tests',
        ),
        'App\\BaseModel\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'App\\BaseLib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/libs',
        ),
        'App\\BaseController\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
        'App\\Action\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/actions',
        ),
    );

    public static $classMap = array (
        'App\\Action\\SendMail' => __DIR__ . '/../..' . '/app/actions/SendMail.php',
        'App\\BaseController\\Controller' => __DIR__ . '/../..' . '/app/controllers/Controller.php',
        'App\\BaseLib\\Lib' => __DIR__ . '/../..' . '/app/libs/Lib.php',
        'App\\BaseModel\\Model' => __DIR__ . '/../..' . '/app/models/Model.php',
        'App\\BaseView\\View' => __DIR__ . '/../..' . '/app/views/_view.php',
        'App\\Config\\ConnectToMikroTik' => __DIR__ . '/../..' . '/app/config/ConnectToMikroTik.php',
        'App\\Config\\Db' => __DIR__ . '/../..' . '/app/config/Db.php',
        'App\\Config\\Query\\MySQlQuery' => __DIR__ . '/../..' . '/app/config/query/MySQlQuery.php',
        'App\\Config\\Query\\OracalQuery' => __DIR__ . '/../..' . '/app/config/query/OracalQuery.php',
        'App\\Inteface\\IDatabaseConnectionable' => __DIR__ . '/../..' . '/app/interfaces/IDatabaseConnectionable.php',
        'App\\Inteface\\IQueryable' => __DIR__ . '/../..' . '/app/interfaces/IQueryable.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite3635c1f365bfde9467e9315b0a1deff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite3635c1f365bfde9467e9315b0a1deff::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite3635c1f365bfde9467e9315b0a1deff::$classMap;

        }, null, ClassLoader::class);
    }
}

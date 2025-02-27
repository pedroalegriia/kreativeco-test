<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b596d868a5e0c633d300b46403e11ec
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pedroalegria\\KreativecoPrueba\\' => 30,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pedroalegria\\KreativecoPrueba\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b596d868a5e0c633d300b46403e11ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b596d868a5e0c633d300b46403e11ec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2b596d868a5e0c633d300b46403e11ec::$classMap;

        }, null, ClassLoader::class);
    }
}

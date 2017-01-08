<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite850f041d88217e13294771a6457f1a0
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Simplon\\Mysql\\' => 14,
        ),
        'P' => 
        array (
            'Predis\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Simplon\\Mysql\\' => 
        array (
            0 => __DIR__ . '/..' . '/simplon/mysql/src',
        ),
        'Predis\\' => 
        array (
            0 => __DIR__ . '/..' . '/predis/predis/src',
        ),
    );

    public static $classMap = array (
        'PHP_Timer' => __DIR__ . '/..' . '/phpunit/php-timer/src/Timer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite850f041d88217e13294771a6457f1a0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite850f041d88217e13294771a6457f1a0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite850f041d88217e13294771a6457f1a0::$classMap;

        }, null, ClassLoader::class);
    }
}
<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67dfd1ab8632b61b4db43dae76b59c75
{
    public static $prefixLengthsPsr4 = array (
        'e' => 
        array (
            'epii\\admin\\ui\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'epii\\admin\\ui\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit67dfd1ab8632b61b4db43dae76b59c75::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit67dfd1ab8632b61b4db43dae76b59c75::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
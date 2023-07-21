<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7809ce4a7f932fce71d814c119c7ba17
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Emmanuel\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Emmanuel\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7809ce4a7f932fce71d814c119c7ba17::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7809ce4a7f932fce71d814c119c7ba17::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7809ce4a7f932fce71d814c119c7ba17::$classMap;

        }, null, ClassLoader::class);
    }
}

<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85cb766d5633f04d0b685eb8ff30c7f5
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MIQID\\Plugin\\WooCommerce\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MIQID\\Plugin\\WooCommerce\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit85cb766d5633f04d0b685eb8ff30c7f5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85cb766d5633f04d0b685eb8ff30c7f5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit85cb766d5633f04d0b685eb8ff30c7f5::$classMap;

        }, null, ClassLoader::class);
    }
}
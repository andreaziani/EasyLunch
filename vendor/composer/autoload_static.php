<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd8f46290185cf80bb57110cf8efee312
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'View\\' => 5,
        ),
        'U' => 
        array (
            'Utils\\' => 6,
        ),
        'M' => 
        array (
            'Model\\Data\\' => 11,
            'Model\\' => 6,
        ),
        'C' => 
        array (
            'Controller\\Action\\' => 18,
            'Controller\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'View\\' => 
        array (
            0 => __DIR__ . '/../..' . '/view',
        ),
        'Utils\\' => 
        array (
            0 => __DIR__ . '/../..' . '/utils',
        ),
        'Model\\Data\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model/data',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model',
        ),
        'Controller\\Action\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller/action',
        ),
        'Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd8f46290185cf80bb57110cf8efee312::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd8f46290185cf80bb57110cf8efee312::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
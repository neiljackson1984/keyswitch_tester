<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa839053836554a1ab5fa19ffdbd653a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DeepCopy\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DeepCopy\\' => 
        array (
            0 => __DIR__ . '/..' . '/myclabs/deep-copy/src/DeepCopy',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa839053836554a1ab5fa19ffdbd653a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa839053836554a1ab5fa19ffdbd653a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

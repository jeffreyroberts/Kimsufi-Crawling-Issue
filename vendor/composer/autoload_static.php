<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit545602e10ca521c98a24142cc1df1367
{
    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'RollingCurl' => 
            array (
                0 => __DIR__ . '/..' . '/chuyskywalker/rolling-curl/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit545602e10ca521c98a24142cc1df1367::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}

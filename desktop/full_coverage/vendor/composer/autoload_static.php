<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0d89a4e8be5bdc7cf485b76568e81814
{
    public static $prefixesPsr0 = array (
        'N' => 
        array (
            'NlpTools\\' => 
            array (
                0 => __DIR__ . '/..' . '/nlp-tools/nlp-tools/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit0d89a4e8be5bdc7cf485b76568e81814::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit0d89a4e8be5bdc7cf485b76568e81814::$classMap;

        }, null, ClassLoader::class);
    }
}

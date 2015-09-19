<?php

/**
 * PSR-4 autoload implementations are left to the developer, and can be project specific.  Below seems to work well.
 *
 * @param string $class The fully-qualified class name
 * @return void
 */
spl_autoload_register(function ($class) {
    // Project-specific namespace prefix.  Could be nested, e.g.: Foo\\Bar\\
    $prefix = 'Rest\\';
    // Base directory for the namespace prefix.  E.g.: rest/src/ and generally: /path/to/project/src
    $base_dir = __DIR__ . '/src/';
    // Check the class contains the namespace prefix
    $len = strlen($prefix);
    if(strncmp($prefix, $class, $len) !== 0) {
        // If not, move along to next registered autoloader
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace namespace prefix with the base directory, replace namespace separators with directory separators in the relative class name, append with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if(file_exists($file)) {
        // Require the file if it exists
        require $file;
    }
});
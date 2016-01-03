<?php

namespace Donquixote\HastyReflectionCommon\ClassLoader;

use Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface;

class ClassLoader_Native implements ClassLoaderInterface {

  /**
   * @param string $class
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface $canvas
   */
  function loadClass($class, ClassLoaderCanvasInterface $canvas) {
    try {
      $reflectionClass = new \ReflectionClass($class);
      $file = $reflectionClass->getFileName();
      if (FALSE === $file) {
        // This should not happen.
        // $file is only FALSE for core classes, which should never hit autoload.
        return;
      }
      $canvas->includeOnce($file);
    }
    catch (\ReflectionException $e) {
      return;
    }
  }

}

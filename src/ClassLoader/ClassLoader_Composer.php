<?php

namespace Donquixote\HastyReflectionCommon\ClassLoader;

use Composer\Autoload\ClassLoader as ComposerClassLoader;
use Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface;

class ClassLoader_Composer implements ClassLoaderInterface {

  /**
   * @var \Composer\Autoload\ClassLoader
   */
  private $composerClassLoader;

  /**
   * @param \Composer\Autoload\ClassLoader $composerClassLoader
   */
  function __construct(ComposerClassLoader $composerClassLoader) {
    $this->composerClassLoader = $composerClassLoader;
  }

  /**
   * @param string $class
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface $canvas
   */
  function loadClass($class, ClassLoaderCanvasInterface $canvas) {
    $file = $this->composerClassLoader->findFile($class);
    if (FALSE === $file) {
      return;
    }
    $canvas->includeOnce($file);
  }
}

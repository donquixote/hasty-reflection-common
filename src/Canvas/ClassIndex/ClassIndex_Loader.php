<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

use Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface;
use Donquixote\HastyReflectionCommon\ClassLoader\ClassLoaderInterface;

class ClassIndex_Loader extends ClassIndex_SemiNative {

  /**
   * @var \Donquixote\HastyReflectionCommon\ClassLoader\ClassLoaderInterface
   */
  private $classLoader;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface $fileIncludeCanvas
   * @param \Donquixote\HastyReflectionCommon\ClassLoader\ClassLoaderInterface $classLoader
   */
  function __construct(FileIndexInterface $fileIncludeCanvas, ClassLoaderInterface $classLoader) {
    parent::__construct($fileIncludeCanvas);
    $this->classLoader = $classLoader;
  }

  /**
   * @param string $class
   */
  protected function triggerAutoload($class) {
    $this->classLoader->loadClass($class, $this);
    try {
      $reflectionClass = new \ReflectionClass($class);
      $this->initKnownClass($class, $reflectionClass);
    }
    catch (\ReflectionException $e) {
      return;
    }
  }

}

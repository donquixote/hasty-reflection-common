<?php

namespace Donquixote\HastyReflectionCommon\ClassLoader;

use Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface;

interface ClassLoaderInterface {

  /**
   * @param string $class
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface $canvas
   */
  function loadClass($class, ClassLoaderCanvasInterface $canvas);
}

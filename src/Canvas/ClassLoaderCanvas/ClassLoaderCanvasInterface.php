<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas;

interface ClassLoaderCanvasInterface {

  /**
   * @param string $class
   *
   * @return bool
   */
  function classLikeIsDefined($class);

  /**
   * @param string $file
   */
  function includeOnce($file);
}

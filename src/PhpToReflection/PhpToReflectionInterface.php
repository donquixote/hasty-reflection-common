<?php

namespace Donquixote\HastyReflectionCommon\PhpToReflection;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;

interface PhpToReflectionInterface {

  /**
   * @param string $php
   *   Entire contents of a PHP file.
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\File\FileReflection|null
   */
  function phpGetReflection($php, ClassIndexInterface $autoloadSource);

}

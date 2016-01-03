<?php

namespace Donquixote\HastyReflectionCommon\Canvas\File;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;

interface FileIndexInterface {

  /**
   * @param string $file
   * @param string|null $php
   *   (optional) PHP contents of the file.
   *   This can be used to avoid reading a file twice.
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\File\FileReflectionInterface|null
   */
  function fileGetReflection($file, ClassIndexInterface $autoloadSource, $php = NULL);

}

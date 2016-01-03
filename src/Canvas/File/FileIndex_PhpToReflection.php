<?php

namespace Donquixote\HastyReflectionCommon\Canvas\File;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;
use Donquixote\HastyReflectionCommon\PhpToReflection\PhpToReflectionInterface;

class FileIndex_PhpToReflection implements FileIndexInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\PhpToReflection\PhpToReflectionInterface
   */
  private $phpToReflection;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\File\FileReflectionInterface[]|mixed[]
   */
  private $includedFiles = array();

  /**
   * @param \Donquixote\HastyReflectionCommon\PhpToReflection\PhpToReflectionInterface $phpToReflection
   */
  function __construct(PhpToReflectionInterface $phpToReflection) {
    $this->phpToReflection = $phpToReflection;
  }

  /**
   * @param string $file
   * @param string|null $php
   *   (optional) PHP contents of the file.
   *   This can be used to avoid reading a file twice.
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\File\FileReflectionInterface|null
   */
  function fileGetReflection($file, ClassIndexInterface $autoloadSource, $php = NULL) {
    if (array_key_exists($file, $this->includedFiles)) {
      return $this->includedFiles[$file];
    }
    if (NULL === $php) {
      if (!is_file($file) || !is_readable($file)) {
        // @todo Throw an exception?
        $this->includedFiles[$file] = NULL;
        return NULL;
      }
      $php = file_get_contents($file);
    }
    return $this->includedFiles[$file] = $this->phpToReflection->phpGetReflection($php, $autoloadSource);
  }
}

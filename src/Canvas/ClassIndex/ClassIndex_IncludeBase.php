<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

use Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface;
use Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface;

abstract class ClassIndex_IncludeBase extends ClassIndexBase implements ClassLoaderCanvasInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface
   */
  private $fileIndex;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface $fileIndex
   */
  function __construct(FileIndexInterface $fileIndex) {
    $this->fileIndex = $fileIndex;
  }

  /**
   * @param string $file
   */
  function includeOnce($file) {
    $fileReflection = $this->fileIndex->fileGetReflection($file, $this);
    foreach ($fileReflection->getClassLikesByQcn() as $name => $classLikeReflection) {
      $this->registerClassLikeReflection($name, $classLikeReflection);
    }
  }
}

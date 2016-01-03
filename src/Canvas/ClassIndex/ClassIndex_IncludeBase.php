<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

use Donquixote\HastyReflectionCommon\Canvas\ClassLoaderCanvas\ClassLoaderCanvasInterface;
use Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface;

abstract class ClassIndex_IncludeBase extends ClassIndexBase implements ClassLoaderCanvasInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface
   */
  private $fileIncludeCanvas;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\File\FileIndexInterface $fileIncludeCanvas
   */
  function __construct(FileIndexInterface $fileIncludeCanvas) {
    $this->fileIncludeCanvas = $fileIncludeCanvas;
  }

  /**
   * @param string $file
   */
  function includeOnce($file) {
    $fileReflection = $this->fileIncludeCanvas->fileGetReflection($file, $this);
    foreach ($fileReflection->getClassLikesByQcn() as $name => $classLikeReflection) {
      $this->registerClassLikeReflection($name, $classLikeReflection);
    }
  }
}

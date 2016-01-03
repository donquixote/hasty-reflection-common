<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndex_IncludeBase;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflection_Native;

class ClassIndex_SemiNative extends ClassIndex_IncludeBase {

  /**
   * @param string $class
   */
  protected function triggerAutoload($class) {
    try {
      $reflectionClass = new \ReflectionClass($class);
      $this->initKnownClass($class, $reflectionClass);
    }
    catch (\ReflectionException $e) {
      return;
    }
  }

  /**
   * @param string $class
   * @param \ReflectionClass $reflectionClass
   */
  protected function initKnownClass($class, \ReflectionClass $reflectionClass) {
    $file = $reflectionClass->getFileName();
    if (FALSE !== $file) {
      $this->includeOnce($file);
    }
    else {
      $this->initCoreClass($class, $reflectionClass);
    }
  }

  /**
   * @param string $class
   * @param \ReflectionClass $reflectionClass
   */
  protected function initCoreClass($class, \ReflectionClass $reflectionClass) {
    $classLikeReflection = ClassLikeReflection_Native::createFromReflection($class, $reflectionClass, $this);
    $this->registerClassLikeReflection($class, $classLikeReflection);
  }
}

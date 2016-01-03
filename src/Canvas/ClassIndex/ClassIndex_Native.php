<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflection_Native;

class ClassIndex_Native extends ClassIndexBase {

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
    $classReflection = ClassLikeReflection_Native::createFromReflection($class, $reflectionClass, $this);
    $this->registerClassLikeReflection($class, $classReflection);
  }
}

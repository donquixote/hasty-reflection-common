<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface;

abstract class ClassIndexBase implements ClassIndexInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  private $classLikesByQcn = array();

  /**
   * @param string $class
   *
   * @return bool
   */
  function classLikeIsDefined($class) {
    return isset($this->classLikesByQcn[$class]);
  }

  /**
   * @param string $class
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null
   */
  function classGetReflection($class) {
    if (array_key_exists($class, $this->classLikesByQcn)) {
      return $this->classLikesByQcn[$class];
    }
    if (class_exists($class, FALSE) || interface_exists($class, FALSE) || trait_exists($class, FALSE)) {
      $reflectionClass = new \ReflectionClass($class);
      $this->initKnownClass($class, $reflectionClass);
    }
    else {
      $this->triggerAutoload($class);
    }
    if (isset($this->classLikesByQcn[$class])) {
      return $this->classLikesByQcn[$class];
    }
    if (array_key_exists($class, $this->classLikesByQcn)) {
      return $this->classLikesByQcn[$class];
    }
    return NULL;
  }

  /**
   * @param string $name
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface $classLikeReflection
   */
  protected function registerClassLikeReflection($name, ClassLikeReflectionInterface $classLikeReflection) {
    if (array_key_exists($name, $this->classLikesByQcn)) {
      // Class already defined.
      // @todo Throw an exception?
      return;
    }
    $this->classLikesByQcn[$name] = $classLikeReflection;
  }

  /**
   * @param string $class
   */
  abstract protected function triggerAutoload($class);

  /**
   * @param string $class
   * @param \ReflectionClass $reflectionClass
   */
  abstract protected function initKnownClass($class, \ReflectionClass $reflectionClass);
}

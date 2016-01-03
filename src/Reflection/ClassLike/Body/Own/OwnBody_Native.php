<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;
use Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflection_Native;

class OwnBody_Native extends OwnBodyBase {

  /**
   * @var \ReflectionClass
   */
  private $reflectionClass;

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface
   */
  private $autoloadSource;

  /**
   * @param \ReflectionClass $reflectionClass
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   */
  function __construct(\ReflectionClass $reflectionClass, ClassIndexInterface $autoloadSource) {
    $this->reflectionClass = $reflectionClass;
    $this->autoloadSource = $autoloadSource;
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  protected function findOwnMethod($name) {
    try {
      $reflectionMethod = $this->reflectionClass->getMethod($name);
      $classReflection = $this->autoloadSource->classGetReflection($this->reflectionClass->getName());
      if ($this->reflectionClass->getName() !== $reflectionMethod->getDeclaringClass()->getName()) {
        return NULL;
      }
      return new MethodReflection_Native($classReflection, $reflectionMethod);
    }
    catch (\ReflectionException $e) {
      return NULL;
    }
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  protected function findOwnMethods() {
    $classReflection = $this->autoloadSource->classGetReflection($this->reflectionClass->getName());
    if (NULL === $classReflection) {
      return array();
    }
    $methods = array();
    foreach ($this->reflectionClass->getMethods() as $reflectionMethod) {
      if ($this->reflectionClass->getName() === $reflectionMethod->getDeclaringClass()->getName()) {
        $methods[$reflectionMethod->getName()] = new MethodReflection_Native($classReflection, $reflectionMethod);
      }
    }
    return $methods;
  }
}

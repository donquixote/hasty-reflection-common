<?php

namespace Donquixote\HastyReflectionCommon\Reflection\FunctionLike;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface;

class MethodReflection_Native extends MethodReflectionBase {

  /**
   * @var \ReflectionMethod
   */
  private $reflectionMethod;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface $declaringClass
   * @param \ReflectionMethod $reflectionMethod
   */
  function __construct(ClassLikeReflectionInterface $declaringClass, \ReflectionMethod $reflectionMethod) {
    parent::__construct($declaringClass);
    $this->reflectionMethod = $reflectionMethod;
  }

  /**
   * @return string
   */
  function getDocComment() {
    return $this->reflectionMethod->getDocComment();
  }

  /**
   * @return bool
   */
  function isByReference() {
    return $this->reflectionMethod->returnsReference();
  }

  /**
   * @return bool
   */
  function isStatic() {
    return $this->reflectionMethod->isStatic();
  }

  /**
   * @return bool
   */
  function isAbstract() {
    return $this->reflectionMethod->isAbstract();
  }

  /**
   * @return bool
   */
  function isPrivate() {
    return $this->reflectionMethod->isPrivate();
  }

  /**
   * @return bool
   */
  function isPublic() {
    return $this->reflectionMethod->isPublic();
  }

  /**
   * @return bool
   */
  function isProtected() {
    return $this->reflectionMethod->isProtected();
  }

  /**
   * @return string
   */
  function getName() {
    return $this->reflectionMethod->getName();
  }
}

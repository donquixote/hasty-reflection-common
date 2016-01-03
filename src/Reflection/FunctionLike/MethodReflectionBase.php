<?php

namespace Donquixote\HastyReflectionCommon\Reflection\FunctionLike;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface;

abstract class MethodReflectionBase implements MethodReflectionInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface
   */
  private $declaringClass;

  /**
   * @var string
   */
  private $declaringClassName;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface $declaringClass
   */
  function __construct(ClassLikeReflectionInterface $declaringClass) {
    $this->declaringClass = $declaringClass;
    $this->declaringClassName = $declaringClass->getName();
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  function getNamespaceUseContext() {
    return $this->declaringClass->getNamespaceUseContext();
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface
   */
  function getDeclaringClass() {
    return $this->declaringClass;
  }

  /**
   * @return string
   */
  function getDeclaringClassName() {
    return $this->declaringClassName;
  }

  /**
   * @return string
   *   E.g. "Acme\\Tiger::foo" for Acme\Tiger::foo()
   */
  function getQualifiedName() {
    return $this->getDeclaringClassName() . '::' . $this->getName();
  }
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header;

class ClassLikeHeader_Native implements ClassLikeHeaderInterface {

  /**
   * @var \ReflectionClass
   */
  private $reflectionClass;

  /**
   * @var bool
   */
  private $isClass;

  /**
   * @param \ReflectionClass $reflectionClass
   */
  function __construct(\ReflectionClass $reflectionClass) {
    $this->reflectionClass = $reflectionClass;
    $this->isClass = !$reflectionClass->isInterface() && !$reflectionClass->isTrait();
  }

  /**
   * @return string
   */
  function getName() {
    return $this->reflectionClass->getName();
  }

  /**
   * @return string|null
   */
  function getDocComment() {
    return $this->reflectionClass->getDocComment();
  }

  /**
   * @return bool
   */
  function isInterface() {
    return $this->reflectionClass->isInterface();
  }

  /**
   * @return bool
   */
  function isClass() {
    return !$this->reflectionClass->isTrait() && !$this->reflectionClass->isInterface();
  }

  /**
   * @return bool
   */
  function isTrait() {
    return $this->reflectionClass->isTrait();
  }

  /**
   * @return bool
   */
  function isAbstractClass() {
    return $this->isClass && $this->reflectionClass->isAbstract();
  }

  /**
   * @return bool
   */
  function isFinal() {
    return $this->reflectionClass->isFinal();
  }
}

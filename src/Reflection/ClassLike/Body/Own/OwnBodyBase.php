<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own;

abstract class OwnBodyBase implements OwnBodyInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  private $methods = array();

  /**
   * @var bool
   */
  private $methodsComplete = FALSE;

  /**
   * @var bool[]
   */
  private $methodsNotFound = array();

  /**
   * @var bool|null
   */
  private $hasOwnMethods;

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getOwnMethod($name) {
    if (isset($this->methods[$name])) {
      return $this->methods[$name];
    }
    if ($this->methodsComplete) {
      return NULL;
    }
    if (array_key_exists($name, $this->methodsNotFound)) {
      return NULL;
    }
    $methodObj = $this->findOwnMethod($name);
    if (NULL === $methodObj) {
      $this->methodsNotFound[$name] = TRUE;
      return NULL;
    }
    $this->methods[$name] = $methodObj;
    return $methodObj;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getOwnMethods() {
    if ($this->methodsComplete) {
      return $this->methods;
    }
    else {
      $this->methods += $this->findOwnMethods();
      $this->methodsComplete = TRUE;
      return $this->methods;
    }
  }

  /**
   * @return bool
   */
  function hasOwnMethods() {
    return NULL !== $this->hasOwnMethods
      ? $this->hasOwnMethods
      : $this->hasOwnMethods = $this->calcHasOwnMethods();
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  abstract protected function findOwnMethod($name);

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  abstract protected function findOwnMethods();

  /**
   * @return bool
   */
  abstract protected function calcHasOwnMethods();
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete;

abstract class CompleteBodyBase implements CompleteBodyInterface {

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
  private $hasMethods;

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getMethod($name) {
    if (isset($this->methods[$name])) {
      return $this->methods[$name];
    }
    if ($this->methodsComplete) {
      return NULL;
    }
    if (array_key_exists($name, $this->methodsNotFound)) {
      return NULL;
    }
    $methodObj = $this->findMethod($name);
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
  function getMethods() {
    if ($this->methodsComplete) {
      return $this->methods;
    }
    else {
      $knownMethods = $this->methods;
      $this->methods = $this->findMethods();
      foreach ($knownMethods as $methodName => $knownMethod) {
        $this->methods[$methodName] = $knownMethod;
      }
      $this->methodsComplete = TRUE;
      return $this->methods;
    }
  }

  /**
   * @return bool
   */
  function hasMethods() {
    return NULL !== $this->hasMethods
      ? $this->hasMethods
      : $this->hasMethods = $this->calcHasMethods();
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  abstract protected function findMethod($name);

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  abstract protected function findMethods();

  /**
   * @return bool
   */
  abstract protected function calcHasMethods();
}

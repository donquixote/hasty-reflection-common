<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete;

interface CompleteBodyInterface {

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getMethod($name);

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getMethods();

  /**
   * @return bool
   */
  function hasMethods();

}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own;

interface OwnBodyInterface {

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getOwnMethod($name);

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getOwnMethods();

}

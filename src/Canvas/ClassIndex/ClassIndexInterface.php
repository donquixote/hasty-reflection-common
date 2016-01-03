<?php

namespace Donquixote\HastyReflectionCommon\Canvas\ClassIndex;

interface ClassIndexInterface {

  /**
   * @param string $class
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null
   */
  function classGetReflection($class);

}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends;

class ClassExtends_None implements ClassExtendsInterface {

  /**
   * Gets the parent class, or NULL if it does not have one.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null
   */
  function getParentClass() {
    return NULL;
  }
}

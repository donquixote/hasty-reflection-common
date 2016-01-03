<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces;

interface OwnInterfacesInterface {

  /**
   * Gets the interfaces directly/explicitly implemented or extended by this
   * class or interface.
   *
   * This does not include interfaces implemented by parent classes, or extended
   * by explicitly implemented interfaces.
   *
   * If the class itself is an interface, it will NOT be part of the returned
   * array.
   *
   * Some implementations with no access to a parser might simply return ALL
   * interfaces, but without the class itself, if it is an interface.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getOwnInterfaces();

}

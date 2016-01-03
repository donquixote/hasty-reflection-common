<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Inheritance;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface;

class Inheritance_Composite implements InheritanceInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface
   */
  private $extends;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface
   */
  private $interfacesAll;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface
   */
  private $ownInterfaces;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface $interfacesAll
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface $ownInterfaces
   */
  function __construct(ClassExtendsInterface $extends, AllInterfacesInterface $interfacesAll, OwnInterfacesInterface $ownInterfaces) {
    $this->extends = $extends;
    $this->interfacesAll = $interfacesAll;
    $this->ownInterfaces = $ownInterfaces;
  }

  /**
   * Gets the parent class, or NULL if it does not have one.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null
   */
  function getParentClass() {
    return $this->extends->getParentClass();
  }

  /**
   * Gets all interfaces directly or indirectly implemented by this class.
   *
   * Will include the class itself if it is an interface.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getAllInterfaces() {
    return $this->interfacesAll->getAllInterfaces();
  }

  /**
   * @param string $interfaceName
   *
   * @return bool
   */
  function extendsOrImplementsInterface($interfaceName) {
    return $this->interfacesAll->extendsOrImplementsInterface($interfaceName);
  }

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
  function getOwnInterfaces() {
    return $this->ownInterfaces->getOwnInterfaces();
  }
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike;

use Donquixote\HastyReflectionCommon\Util\UtilBase;
use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBody_Composite;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBody_Native;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtends_ByName;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtends_None;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header\ClassLikeHeader_Native;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfaces_FromNames;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfaces_FromNames;
use Donquixote\HastyReflectionCommon\Reflection\Declaration;

final class ClassLikeReflection_Native extends UtilBase {

  /**
   * @param string $name
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface
   */
  static function createFromName($name, ClassIndexInterface $autoloadSource) {
    $reflectionClass = new \ReflectionClass($name);
    return self::createFromReflection($name, $reflectionClass, $autoloadSource);
  }

  /**
   * @param string $name
   * @param \ReflectionClass $reflectionClass
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $classIndex
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflection_Composite
   */
  static function createFromReflection($name, \ReflectionClass $reflectionClass, ClassIndexInterface $classIndex) {

    $declaration = Declaration::createFromReflection($reflectionClass);

    $header = new ClassLikeHeader_Native($reflectionClass);

    $extends = ($parentReflectionClass = $reflectionClass->getParentClass())
      ? new ClassExtends_ByName($classIndex, $parentReflectionClass->getName())
      : new ClassExtends_None();

    $ownInterfaceNames = $reflectionClass->getInterfaceNames();
    $allInterfaceNames = $ownInterfaceNames;
    $interfacesAll = new AllInterfaces_FromNames($classIndex, $allInterfaceNames);
    if ($reflectionClass->isInterface()) {
      $interfacesAll = $interfacesAll->withSelfInterfaceName($name, $classIndex);
    }
    $ownInterfaces = new OwnInterfaces_FromNames($classIndex, $ownInterfaceNames);

    $ownBody = new OwnBody_Native($reflectionClass, $classIndex);
    $body = ClassLikeBody_Composite::createFromOwnBody($extends, $interfacesAll, $ownBody);

    return new ClassLikeReflection_Composite($declaration, $header, $extends, $interfacesAll, $ownInterfaces, $body, $classIndex);
  }

}

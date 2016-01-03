<?php

namespace Donquixote\HastyReflectionCommon\Util;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface;

final class ReflectionUtil extends UtilBase {

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface $classLikeReflection
   *
   * @return array|\Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  static function classLikeGetFirstLevelInterfaces(ClassLikeReflectionInterface $classLikeReflection) {
    if ($classLikeReflection->isInterface()) {
      return array($classLikeReflection->getName() => $classLikeReflection);
    }
    $interfaces = $classLikeReflection->getOwnInterfaces();
    if (NULL !== $parentClass = $classLikeReflection->getParentClass()) {
      $interfaces += self::classLikeGetFirstLevelInterfaces($parentClass);
    }
    return $interfaces;
  }

}

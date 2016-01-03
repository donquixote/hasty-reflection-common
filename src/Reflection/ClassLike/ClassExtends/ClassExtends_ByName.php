<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;

class ClassExtends_ByName implements ClassExtendsInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface
   */
  private $autoloadSource;

  /**
   * @var string
   */
  private $parentClassQcn;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null|false
   */
  private $parentClass = FALSE;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   * @param string|null $parentClassQcn
   */
  function __construct(ClassIndexInterface $autoloadSource, $parentClassQcn) {
    $this->autoloadSource = $autoloadSource;
    $this->parentClassQcn = $parentClassQcn;
  }

  /**
   * Gets the parent class, or NULL if it does not have one.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null
   */
  function getParentClass() {
    return FALSE !== $this->parentClass
      ? $this->parentClass
      : $this->parentClass = $this->buildParentClass();
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface|null
   */
  private function buildParentClass() {
    if (NULL === $this->parentClassQcn) {
      return NULL;
    }
    $classLikeReflection = $this->autoloadSource->classGetReflection($this->parentClassQcn);
    if (!$classLikeReflection || !$classLikeReflection->isClass()) {
      return NULL;
    }
    return $classLikeReflection;
  }

}

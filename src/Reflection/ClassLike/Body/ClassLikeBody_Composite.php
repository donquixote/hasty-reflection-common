<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBody_DecoratorTrait;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBody_FromOwn;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBody_DecoratorTrait;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBody_FromComplete;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;

class ClassLikeBody_Composite implements ClassLikeBodyInterface {

  use OwnBody_DecoratorTrait, CompleteBody_DecoratorTrait;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface $interfacesAll
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface $ownBody
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBodyInterface
   */
  static function createFromOwnBody(ClassExtendsInterface $extends, AllInterfacesInterface $interfacesAll, OwnBodyInterface $ownBody) {
    return new self($ownBody, new CompleteBody_FromOwn($extends, $interfacesAll, $ownBody));
  }

  /**
   * @param string $qcn
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface $completeBody
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBody_Composite
   */
  static function createFromCompleteBody($qcn, CompleteBodyInterface $completeBody) {
    return new self(new OwnBody_FromComplete($qcn, $completeBody), $completeBody);
  }

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface $ownBody
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface $completeBody
   */
  function __construct(OwnBodyInterface $ownBody, CompleteBodyInterface $completeBody) {
    $this->ownBody = $ownBody;
    $this->completeBody = $completeBody;
  }

  /**
   * @return bool
   */
  function hasMethods() {
    return $this->completeBody->hasMethods();
  }

  /**
   * @return bool
   */
  function hasOwnMethods() {
    return $this->ownBody->hasOwnMethods();
  }
}

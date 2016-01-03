<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBodyInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header\ClassLikeHeaderInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Inheritance\Inheritance_Composite;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface;
use Donquixote\HastyReflectionCommon\Reflection\DeclarationInterface;

class ClassLikeReflection_Composite extends Inheritance_Composite implements ClassLikeReflectionInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\DeclarationInterface
   */
  private $declaration;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header\ClassLikeHeaderInterface
   */
  private $header;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBodyInterface
   */
  private $body;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\DeclarationInterface $declaration
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header\ClassLikeHeaderInterface $header
   * @param ClassExtendsInterface $extends
   * @param AllInterfacesInterface $interfacesAll
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface $ownInterfaces
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBodyInterface $body
   */
  function __construct(
    DeclarationInterface $declaration,
    ClassLikeHeaderInterface $header,
    ClassExtendsInterface $extends,
    AllInterfacesInterface $interfacesAll,
    OwnInterfacesInterface $ownInterfaces,
    ClassLikeBodyInterface $body
  ) {
    parent::__construct($extends, $interfacesAll, $ownInterfaces);
    $this->declaration = $declaration;
    $this->header = $header;
    $this->body = $body;
  }

  /**
   * @return string|null
   */
  function getDocComment() {
    return $this->declaration->getDocComment();
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  function getNamespaceUseContext() {
    return $this->declaration->getNamespaceUseContext();
  }

  /**
   * @return bool
   */
  function isInterface() {
    return $this->header->isInterface();
  }

  /**
   * @return bool
   */
  function isClass() {
    return $this->header->isClass();
  }

  /**
   * @return bool
   */
  function isTrait() {
    return $this->header->isTrait();
  }

  /**
   * @return bool
   */
  function isAbstractClass() {
    return $this->header->isAbstractClass();
  }

  /**
   * @return bool
   */
  function isFinal() {
    return $this->header->isFinal();
  }

  /**
   * @return string
   */
  function getName() {
    return $this->header->getName();
  }

  /**
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getConstructor() {
    return $this->body->getConstructor();
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getMethod($name) {
    return $this->body->getMethod($name);
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getMethods() {
    return $this->body->getMethods();
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getOwnMethod($name) {
    return $this->body->getOwnMethod($name);
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getOwnMethods() {
    return $this->body->getOwnMethods();
  }

  /**
   * The equivalent of @see \ReflectionClass::isAbstract()
   *
   * @return bool
   */
  function isAbstract() {
    if ($this->header->isAbstractClass()) {
      return TRUE;
    }
    if ($this->header->isTrait()) {
      return TRUE;
    }
    if ($this->header->isInterface()) {
      return $this->body->hasMethods();
    }
    return FALSE;
  }

  /**
   * @return bool
   */
  function hasMethods() {
    static $level = 0;
    if ($level > 4) {
      die($this->getName());
    }
    ++$level;
    $hasOwnMethods = $this->body->hasMethods();
    --$level;
    return $hasOwnMethods;
  }

  /**
   * @return bool
   */
  function hasOwnMethods() {
    static $level = 0;
    if ($level > 4) {
      die($this->getName());
    }
    ++$level;
    $hasOwnMethods = $this->body->hasOwnMethods();
    --$level;
    return $hasOwnMethods;
  }
}

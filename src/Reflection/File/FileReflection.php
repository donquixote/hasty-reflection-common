<?php

namespace Donquixote\HastyReflectionCommon\Reflection\File;

use Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface;

class FileReflection implements FileReflectionInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  private $classesByQcn;

  /**
   * @var \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  private $namespaceUseContext;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[] $classesByQcn
   * @param \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface $namespaceUseContext
   */
  function __construct(array $classesByQcn, NamespaceUseContextInterface $namespaceUseContext) {
    $this->classesByQcn = $classesByQcn;
    $this->namespaceUseContext = $namespaceUseContext;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getClassLikesByQcn() {
    return $this->classesByQcn;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  function getNamespaceUseContext() {
    return $this->namespaceUseContext;
  }
}

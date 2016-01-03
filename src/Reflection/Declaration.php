<?php

namespace Donquixote\HastyReflectionCommon\Reflection;

use Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContext_Empty;
use Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContext_NamespaceOnly;
use Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface;

class Declaration implements DeclarationInterface {

  /**
   * @var null|string
   */
  private $docComment;

  /**
   * @var \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  private $namespaceUseContext;

  /**
   * @param \ReflectionClass $reflectionClass
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\DeclarationInterface
   */
  static function createFromReflection(\ReflectionClass $reflectionClass) {
    $namespaceUseContext = ('' === $namespaceName = $reflectionClass->getNamespaceName())
      ? new NamespaceUseContext_Empty()
      : new NamespaceUseContext_NamespaceOnly($namespaceName);
    return new Declaration($reflectionClass->getDocComment(), $namespaceUseContext);
  }

  /**
   * @param string|null $docComment
   * @param \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface $namespaceUseContext
   */
  function __construct($docComment, NamespaceUseContextInterface $namespaceUseContext) {
    $this->docComment = $docComment;
    $this->namespaceUseContext = $namespaceUseContext;
  }

  /**
   * @return string|null
   */
  function getDocComment() {
    return $this->docComment;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  function getNamespaceUseContext() {
    return $this->namespaceUseContext;
  }
}

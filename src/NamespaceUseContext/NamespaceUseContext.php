<?php

namespace Donquixote\HastyReflectionCommon\NamespaceUseContext;

class NamespaceUseContext implements NamespaceUseContextInterface {

  /**
   * @var string|null
   */
  private $namespaceName;

  /**
   * @var string[]
   */
  private $namesByAlias;

  /**
   * @param string|null $namespaceName
   * @param string[] $namesByAlias
   */
  function __construct($namespaceName = NULL, array $namesByAlias) {
    $this->namespaceName = $namespaceName;
    $this->namesByAlias = $namesByAlias;
  }

  /**
   * @return string|null
   */
  function getNamespaceName() {
    return $this->namespaceName;
  }

  /**
   * @param string $nameOrAlias
   *
   * @return string
   */
  function aliasGetName($nameOrAlias) {
    if ('\\' === $nameOrAlias[0]) {
      return substr($nameOrAlias, 1);
    }
    elseif (array_key_exists($nameOrAlias, $this->namesByAlias)) {
      return $this->namesByAlias[$nameOrAlias];
    }
    elseif (NULL !== $this->namespaceName) {
      return $this->namespaceName . '\\' . $nameOrAlias;
    }
    else {
      return $nameOrAlias;
    }
  }
}

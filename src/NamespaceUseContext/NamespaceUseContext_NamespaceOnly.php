<?php

namespace Donquixote\HastyReflectionCommon\NamespaceUseContext;

class NamespaceUseContext_NamespaceOnly implements NamespaceUseContextInterface {

  /**
   * @var string|null
   */
  private $namespaceName;

  /**
   * @param string|null $namespaceName
   */
  function __construct($namespaceName = NULL) {
    $this->namespaceName = $namespaceName;
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
    elseif (NULL !== $this->namespaceName) {
      return $this->namespaceName . '\\' . $nameOrAlias;
    }
    else {
      return $nameOrAlias;
    }
  }

}

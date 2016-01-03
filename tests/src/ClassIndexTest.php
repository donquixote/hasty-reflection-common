<?php

namespace Donquixote\HastyReflectionCommon\Tests;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndex_Native;
use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndex_SemiNative;
use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;
use Donquixote\HastyReflectionCommon\Canvas\File\FileIndex_PhpToReflection;
use Donquixote\HastyReflectionCommon\ClassLoader\ClassLoader_Composer;
use Donquixote\HastyReflectionCommon\ClassLoader\ClassLoader_Native;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBody_DecoratorTrait;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface;
use Donquixote\HastyReflectionParser\ClassIndex\ClassIndex_Ast;

class ClassIndexTest extends \PHPUnit_Framework_TestCase {

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $classIndex
   * @param string $class
   *
   * @dataProvider provideClassIndexArgs()
   */
  function testClassIndex(ClassIndexInterface $classIndex, $class) {
    $classReflection = $classIndex->classGetReflection($class);
    $reflectionClass = new \ReflectionClass($class);

    // Test name.
    $this->assertEquals($reflectionClass->getName(), $classReflection->getName());

    // Test context.
    $this->assertEquals($reflectionClass->getNamespaceName(), $classReflection->getNamespaceUseContext()->getNamespaceName());

    // Test interfaces
    $this->assertEquals($reflectionClass->getInterfaceNames(), array_keys($classReflection->getOwnInterfaces()));

    foreach ($reflectionClass->getInterfaceNames() as $interfaceName) {
      $this->assertEquals(TRUE, $classReflection->extendsOrImplementsInterface($interfaceName));
    }

    $expectedInterfaceNames = $reflectionClass->getInterfaceNames();
    if ($reflectionClass->isInterface()) {
      array_unshift($expectedInterfaceNames, $class);
    }
    $this->assertEquals($expectedInterfaceNames, array_keys($classReflection->getAllInterfaces()));
  }

  /**
   * @return array[]
   */
  function provideClassIndexArgs() {
    $list = array();
    $composerClassLoader = include dirname(dirname(__DIR__)) . '/vendor/composer/autoload.php';
    $classes = array(
      ClassIndex_SemiNative::class,
      ClassLikeReflectionInterface::class,
      OwnBody_DecoratorTrait::class
    );
    foreach (array(
      ClassIndex_Ast::createWithClassLoader(new ClassLoader_Composer($composerClassLoader)),
      ClassIndex_Ast::createWithClassLoader(new ClassLoader_Native()),
      ClassIndex_Ast::createSemiNative(),
      new ClassIndex_Native(),
    ) as $classIndex) {
      foreach ($classes as $class) {
        $list[] = array($classIndex, $class);
      }
    }
    return $list;
  }

}

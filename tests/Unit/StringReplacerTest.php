<?php
declare(strict_types=1);

namespace Neighborhoods\PrefabTest\Unit;

use Neighborhoods\Prefab\StringReplacer;
use PHPUnit\Framework\TestCase;

class StringReplacerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldThrowIfNamespaceNotSetBeforeReplacingPlaceholders(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'StringReplacer namespace has not been set.'
        );

        $stringReplacer = new StringReplacer();

        $stringReplacer->replacePlaceholders();
    }

    /**
     * @test
     */
    public function shouldGetProvidedNamespace(): void
    {
        $expectedNamespace = "Some\Awesome\Object";

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace($expectedNamespace);

        $this->assertSame(
            $expectedNamespace,
            $stringReplacer->getNamespace()
        );
    }

    /**
     * @test
     */
    public function shouldThrowIfAttemptingToGetNamespaceBeforeItIsSet(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'StringReplacer namespace has not been set.'
        );

        $stringReplacer = new StringReplacer();

        $stringReplacer->getNamespace();
    }

    /**
     * @test
     */
    public function shouldThrowIfNamespaceSetMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'StringReplacer namespace is already set.'
        );

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace('unimportant');
        $stringReplacer->setNamespace('unimportant');
    }

    /**
     * @test
     */
    public function shouldThrowIfFileIsNotSetBeforeReplacingPlaceholders(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'StringReplacer file has not been set.'
        );

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace("Some\Awesome\Object");

        $stringReplacer->replacePlaceholders();
    }

    /**
     * @test
     */
    public function shouldThrowIfFileSetMoreThanOnce(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(
            'StringReplacer file is already set.'
        );

        $stringReplacer = new StringReplacer();

        $stringReplacer->setFile('unimportant');
        $stringReplacer->setFile('unimportant');
    }

    /**
     * @test
     */
    public function shouldReplaceParentNamespacePlaceholder(): void
    {
        $expectedParentNamespace = "Foo\Bar";

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace("$expectedParentNamespace\Baz");

        $stringReplacer->setFile("PARENTNAMESPACEPLACEHOLDER");

        $this->assertSame(
            $expectedParentNamespace,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceTruncatedDaoNamePlaceholder(): void
    {
        $expectedTruncatedDaoName = 'Baz';

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace('Foo\\Bar\\' . $expectedTruncatedDaoName);

        $stringReplacer->setFile('TRUNCATEDDAONAMEPLACEHOLDER');

        $this->assertSame(
            $expectedTruncatedDaoName,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceDaoNamePlaceholder(): void
    {
        $expectedDaoName = "Foo\Bar\Baz";

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace($expectedDaoName);

        $stringReplacer->setFile('DAONAMEPLACEHOLDER');

        $this->assertSame(
            $expectedDaoName,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceDaoVarNamePlaceholder(): void
    {
        $expectedDaoVarName = "Baz";

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace('Foo\\Bar\\' . $expectedDaoVarName);

        $stringReplacer->setFile('DAOVARNAMEPLACEHOLDER');

        $this->assertSame(
            $expectedDaoVarName,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceProjectNamePlaceholder(): void
    {
        $expectedProjectName = 'SomeProject';

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace(
            'Neighborhoods\\' . $expectedProjectName . '\\SomeDao'
        );

        $stringReplacer->setFile('PROJECTNAMEPLACEHOLDER');

        $this->assertSame(
            $expectedProjectName,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceNamespacePlaceholder(): void
    {
        $expectedNamespace = "Foo\Bar\Baz";

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace($expectedNamespace);

        $stringReplacer->setFile('NAMESPACEPLACEHOLDER');

        $this->assertSame(
            $expectedNamespace,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceParentVarnamePlaceholder(): void
    {
        $expectedParentVarname = "Bar";

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace(
            'GreatGrandparent\\GrandParent\\' . $expectedParentVarname . '\\Child'
        );

        $stringReplacer->setFile('PARENTVARNAMEPLACEHOLDER');

        $this->assertSame(
            $expectedParentVarname,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceTruncatedParentNamespacePlaceholder(): void
    {
        $expectedTruncatedParentNamespace = 'GrandParent';

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace(
            'GreatGrandparent\\' . $expectedTruncatedParentNamespace . '\\Parent\\Child'
        );

        $stringReplacer->setFile('TRUNCATEDGRANDPARENTNAMESPACEPLACEHOLDER');

        $this->assertSame(
            $expectedTruncatedParentNamespace,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceUppercaseTruncatedParentNamespacePlaceholder(): void
    {
        $expectedTruncatedParentNamespace = 'GrandParent';
        $expectedUppercaseTruncatedParentNamespace = 'GRANDPARENT';

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace(
            'GreatGrandparent\\' . $expectedTruncatedParentNamespace . '\\Parent\\Child'
        );

        $stringReplacer->setFile('UCTRUNCATEDGRANDPARENTNAMESPACEPLACEHOLDER');

        $this->assertSame(
            $expectedUppercaseTruncatedParentNamespace,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceSelfPlaceholder(): void
    {
        $expectedSelf = 'self';

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace("Foo\Bar\Baz");

        $stringReplacer->setFile('\\SELFPLACEHOLDER');

        $this->assertSame(
            $expectedSelf,
            $stringReplacer->replacePlaceholders()
        );
    }

    /**
     * @test
     */
    public function shouldReplaceAllPlaceholders(): void
    {
        $file = <<<EOF
DAONAMEPLACEHOLDER UCTRUNCATEDGRANDPARENTNAMESPACEPLACEHOLDER
this
DAOVARNAMEPLACEHOLDER
should
\SELFPLACEHOLDER PROJECTNAMEPLACEHOLDER
not
TRUNCATEDDAONAMEPLACEHOLDER
be
NAMESPACEPLACEHOLDER
replaced
PARENTNAMESPACEPLACEHOLDER
next 2 lines should retain whitespace
    blah blah

PARENTVARNAMEPLACEHOLDER TRUNCATEDGRANDPARENTNAMESPACEPLACEHOLDER
EOF;

        $expectedOutput = <<<EOF
GreatGrandparent\Grandparent\Parent\Child GRANDPARENT
this
ParentChild
should
self Grandparent
not
Child
be
GreatGrandparent\Grandparent\Parent\Child
replaced
GreatGrandparent\Grandparent\Parent
next 2 lines should retain whitespace
    blah blah

Parent Grandparent
EOF;

        $stringReplacer = new StringReplacer();

        $stringReplacer->setNamespace(
            "GreatGrandparent\Grandparent\Parent\Child"
        );

        $stringReplacer->setFile($file);

        $this->assertSame(
            $expectedOutput,
            $stringReplacer->replacePlaceholders()
        );
    }
}

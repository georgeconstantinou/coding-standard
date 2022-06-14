<?php declare(strict_types = 1);

namespace SlevomatCodingStandard\Sniffs\Classes;

use SlevomatCodingStandard\Sniffs\TestCase;
use UnexpectedValueException;

class PropertyDeclarationSniffTest extends TestCase
{

	public function testNoErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/propertyDeclarationNoErrors.php');
		self::assertNoSniffErrorInFile($report);
	}

	public function testErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/propertyDeclarationErrors.php');

		self::assertSame(17, $report->getErrorCount());

		self::assertSniffError($report, 6, PropertyDeclarationSniff::CODE_NO_SPACE_BETWEEN_TYPE_HINT_AND_PROPERTY);
		self::assertSniffError($report, 8, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BETWEEN_TYPE_HINT_AND_PROPERTY);
		self::assertSniffError($report, 10, PropertyDeclarationSniff::CODE_WHITESPACE_AFTER_NULLABILITY_SYMBOL);
		self::assertSniffError($report, 12, PropertyDeclarationSniff::CODE_NO_SPACE_BEFORE_NULLABILITY_SYMBOL);
		self::assertSniffError($report, 14, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_NULLABILITY_SYMBOL);
		self::assertSniffError($report, 16, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_TYPE_HINT);
		self::assertSniffError($report, 18, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_TYPE_HINT);
		self::assertSniffError($report, 20, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BETWEEN_TYPE_HINT_AND_PROPERTY);
		self::assertSniffError($report, 22, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_TYPE_HINT);
		self::assertSniffError($report, 24, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_TYPE_HINT);
		self::assertSniffError($report, 24, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BETWEEN_TYPE_HINT_AND_PROPERTY);
		self::assertSniffError($report, 26, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_TYPE_HINT);
		self::assertSniffError($report, 26, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BETWEEN_TYPE_HINT_AND_PROPERTY);
		self::assertSniffError($report, 28, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BEFORE_TYPE_HINT);
		self::assertSniffError($report, 28, PropertyDeclarationSniff::CODE_MULTIPLE_SPACES_BETWEEN_TYPE_HINT_AND_PROPERTY);
		self::assertSniffError($report, 30, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);
		self::assertSniffError($report, 32, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);

		self::assertAllFixedInFile($report);
	}

	public function testModifiedModifiersOrderNoErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/propertyDeclarationModifiedModifiersOrderNoErrors.php', [
			'modifiersOrder' => [
				'static, readonly',
				'var, public, protected, private',
			],
		]);
		self::assertNoSniffErrorInFile($report);
	}

	public function testModifiedModifiersOrderErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/propertyDeclarationModifiedModifiersOrderErrors.php', [
			'modifiersOrder' => [
				'static, readonly',
				'var, public, protected, private',
			],
		], [PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS]);

		self::assertSame(4, $report->getErrorCount());

		self::assertSniffError($report, 6, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);
		self::assertSniffError($report, 8, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);
		self::assertSniffError($report, 10, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);
		self::assertSniffError($report, 12, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);

		self::assertAllFixedInFile($report);
	}

	public function testUnspecifiedModifiersAreOnLastPositionErrors(): void
	{
		$report = self::checkFile(__DIR__ . '/data/propertyDeclarationUnspecifiedModifiersAreOnLastPositionErrors.php', [
			'modifiersOrder' => [
				'var, public, protected',
				'static',
			],
		], [PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS]);

		self::assertSame(3, $report->getErrorCount());

		self::assertSniffError($report, 6, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);
		self::assertSniffError($report, 8, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);
		self::assertSniffError($report, 10, PropertyDeclarationSniff::CODE_INCORRECT_ORDER_OF_MODIFIERS);

		self::assertAllFixedInFile($report);
	}

	public function testUnknownModifier(): void
	{
		self::expectException(UnexpectedValueException::class);
		self::expectExceptionMessage('Unknown property modifier "unknown".');

		self::checkFile(__DIR__ . '/data/propertyDeclarationNoErrors.php', [
			'modifiersOrder' => [
				'unknown',
			],
		]);
	}

}

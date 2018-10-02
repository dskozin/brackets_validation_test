<?php
declare(strict_types=1);

namespace Brackets\Validation;

interface IFormulaValidator
{
	public function valid(string $formula): bool;

	public function getErrorMessages(): array;
}
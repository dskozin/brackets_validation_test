<?php
declare(strict_types=1);

namespace Brackets\Validation;


class RoundBracketsValidation implements IFormulaValidator
{
	private $errors = [];

	public function valid(string $formula): bool
	{
		$this->checkEven($formula);
		$this->checkEmpty($formula);
		return empty($this->errors);
	}

	private function checkEven(string $formula): void
	{
		$even = 0;
		$errors = [];
		foreach (str_split ($formula) as $symbol) {
			if ($symbol === '(') $even++;
			if ($symbol === ')') $even--;
			if ($even < 0)
				$errors['SEQUENCE'] = "There is error in round brackets sequence! Check order of round brackets in formula!";
		}

		if ($even !== 0 && empty($errors))
			$errors['EVEN'] = "Sum of round brackets not even! Check not closed round brackets in formula!";

		$this->errors = array_merge($this->errors, $errors);
	}

	private function checkEmpty(string $formula): void
	{
		if (preg_match('!\(\s*\)!', $formula) !== 0)
			$this->errors['EMPTY'] = "Formula has empty round brackets! Check your formula!";
	}

	public function getErrorMessages(): array
	{
		return $this->errors;
	}
}
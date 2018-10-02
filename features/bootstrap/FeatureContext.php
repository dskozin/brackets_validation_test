<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Brackets\Validation\RoundBracketsValidation;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
	private $validator;
	private $formula;

	/**
	 * Initializes context.
	 *
	 * Every scenario gets its own context instance.
	 * You can also pass arbitrary arguments to the
	 * context constructor through behat.yml.
	 */
	public function __construct()
	{
	}

	/**
	 * @When /^сохраняемая функция "(.*)"$/
	 */
	public function сохраняемаяФункция($arg1)
	{
		$this->formula = $arg1;
	}

	/**
	 * @When /^ожидается что валидация не пройдет$/
	 */
	public function ожидаетсяЧтоВалидацияНеПройдет()
	{
		Assert::assertFalse($this->validator->valid($this->formula));
	}

	/**
	 * @When /^массив ошибок валидатора содержит ключ "([^"]*)"$/
	 */
	public function массивОшибокВалидатораСодержитКлюч($arg1)
	{
		Assert::assertArrayHasKey($arg1, $this->validator->getErrorMessages());
	}

	/**
	 * @When /^у валидатора не пустой массив ошибок$/
	 */
	public function уВалидатораНеПустойМассивОшибок()
	{
		Assert::assertNotEmpty($this->validator->getErrorMessages());
	}

	/**
	 * @When /^используется валидатор круглых скобок$/
	 */
	public function используетсяВалидаторКруглыхСкобок()
	{
		$this->validator = new RoundBracketsValidation();
	}

	/**
	 * @When /^в значении массива с ключом "([^"]*)" содержится ключ "([^"]*)"$/
	 */
	public function вЗначенииМассиваСКлючомСодержитсяКлюч($arg1, $arg2)
	{
		Assert::assertArrayHasKey($arg2, $this->validator->getErrorMessages()[$arg1]);
	}

	/**
	 * @When /^у валидатора пустой массив ошибок$/
	 */
	public function уВалидатораПустойМассивОшибок()
	{
		Assert::assertEmpty($this->validator->getErrorMessages());
	}

	/**
	 * @When /^ожидается что валидация пройдет$/
	 */
	public function ожидаетсяЧтоВалидацияПройдет()
	{
		Assert::assertTrue($this->validator->valid($this->formula));
	}
}

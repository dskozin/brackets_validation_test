<?php
namespace Brackets\Validation;

require __DIR__ . '/../vendor/autoload.php';

class RoundBracketsValidationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProvider_brackets
     */
    public function test_brackets($input, $expected_result, $is_error_expected = false)
    {
        $Validator = new RoundBracketsValidation();
        $this->assertEquals(
            $expected_result,
            $Validator->valid($input),
            'Validation failed : ' . PHP_EOL . implode(PHP_EOL, $Validator->getErrorMessages())
        );
        $this->assertEquals($is_error_expected, !empty($Validator->getErrorMessages()));
    }

    public function dataProvider_brackets()
    {
        return [
            [
                'input' => '()',
                'expected_result' => true
            ],
            [
                'input' => '(!)',
                'expected_result' => true
            ],
            [
                'input' => ')(!)(',
                'expected_result' => false,
                'is_error_expected' => true,
            ],
            [
                'input' => ')()(',
                'expected_result' => false,
                'is_error_expected' => true,
            ],
            [
                'input' => '((qq)())',
                'expected_result' => false,
                'is_error_expected' => true,
            ],
        ];
    }
}
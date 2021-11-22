<?php

namespace Spatie\Health\Checks;

use Spatie\Health\Support\Result;

class EnvironmentCheck extends Check
{
    protected string $expectedEnvironment = 'production';

    public function expectEnvironment(string $expectedEnvironment)
    {
        $this->expectedEnvironment = $expectedEnvironment;

        return $this;
    }

    public function run(): Result
    {
        $actualEnvironment = app()->environment();

        $result = Result::make()->meta([
            'actual' => $actualEnvironment,
            'expected' => $this->expectedEnvironment
        ]);

        return $this->expectedEnvironment === $actualEnvironment
            ? $result->ok()
            : $result->failed("The environment was expected to be `:expected`, but actually was `:actual`");
    }
}
<?php
declare(strict_types=1);

namespace Neighborhoods\ReplaceThisWithTheNameOfYourProduct\Symfony\Component\DependencyInjection;

use Neighborhoods\ReplaceThisWithTheNameOfYourProduct\NewRelic;

class ErrorHandler implements ErrorHandlerInterface
{
    public function __invoke(
        int $error_number,
        string $error_string,
        string $error_file,
        int $error_line
    ): ErrorHandlerInterface {
        (new NewRelic())->noticeError($error_number, $error_string, $error_file, $error_line);

        return $this;
    }
}

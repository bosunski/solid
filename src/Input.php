<?php

namespace Solid;

use Closure;
use Exception;
use stdClass;

class Input
{
    /**
     * Collects CLI Inputs
     *
     * @return stdClass
     * @throws Exception
     */
    public function collectInputs(): stdClass
    {
        if (php_sapi_name() === "cli") {

            $consoleInputs = $this->getCLIInputs();

            return (object) ['id' => $consoleInputs[0]['id'] ?? null, 'amount' => $consoleInputs[1]['amount'] ?? null];
        } elseif (php_sapi_name() === 'fpm-fcgi') {
            return $this->getWebInput();
        }
    }

    protected function getCLIInputs()
    {
        global $argv;

        array_shift($argv);

        if (empty($argv)) {
            throw new Exception("You must provide amount and user ID");
        }

        return array_map(Closure::fromCallable([$this, 'formatInputs']), $argv);
    }

    /**
     * Formats CLI inputs
     *
     * @param string $input
     * @return array
     */
    protected function formatInputs(string $input): array
    {
        list($name, $value) = explode('=', str_replace('--', '', $input));

        return [$name => $value];
    }

    protected  function getWebInput()
    {
        $id = $_GET['id'];
        $amount = $_GET['amount'];

        return (object) ['id' => $id ?? null, 'amount' => $amount ?? null];
    }

}

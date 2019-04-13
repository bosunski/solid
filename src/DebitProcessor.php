<?php

namespace Solid;

use Closure;
use Exception;
use stdClass;

class DebitProcessor
{
    /**
     * @var Biller
     */
    private $biller;

    public function __construct(Biller $biller)
    {
        $this->biller = $biller;
    }

    /**
     * @throws Exception
     */
    public function processDebit(): void
    {
        $inputs = $this->collectInputs();

        $user = $this->getUser($inputs->id);

        if (!$user) {
            throw new Exception(sprintf("The user with the ID: %s doesn't exist!", $inputs->id));
        }

        if ($this->biller->bill($user->id, $inputs->amount)) {
            printf("User: %s has been billed: %d ✅ \n", $user->name, $inputs->amount);
        }
    }

    /**
     * Collects CLI Inputs
     *
     * @return stdClass
     */
    protected function collectInputs(): stdClass
    {
        global $argv;

        array_shift($argv);

        $consoleInputs = array_map(Closure::fromCallable([$this, 'formatInputs']), $argv);

        return (object) ['id' => $consoleInputs[0]['id'], 'amount' => $consoleInputs[1]['amount']];
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

    /**
     * @param int $userId
     * @return stdClass|null
     */
    protected function getUser(int $userId)
    {
        $userStore = __DIR__ . DIRECTORY_SEPARATOR . "store/users.json";
        $users = json_decode(file_get_contents($userStore));

        foreach ($users as $user) {
            if ($user->id === $userId) return $user;
        }

        return null;
    }
}

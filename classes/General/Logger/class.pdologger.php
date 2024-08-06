<?php

declare(strict_types=1);

namespace General\Logger;

use DateTime;
use DateTimeZone;
use Exception;
use General\Session;
use JetBrains\PhpStorm\ExpectedValues;
use Medoo\Medoo;
use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Stringable;

/**
 * This class is for logging events to the database.
 */
final class PDOLogger extends AbstractLogger
{
    private string $machine;
    private string $date;
    private int $user;

    /**
     * @throws Exception
     */
    public function __construct(
        private readonly Medoo $medoo,
    ) {
        /** @noinspection GlobalVariableUsageInspection */
        $this->machine = $_SERVER['SERVER_ADDR'] ?? '';

        $dt = new DateTime('now', new DateTimeZone('America/New_York'));
        $this->date = $dt->format('Y-m-d H:i:s');

        $this->user = Session::get('user') ?? 0;
    }

    public function log(
        #[ExpectedValues(valuesFromClass: LogLevel::class)]
        $level,
        string|Stringable $message,
        array $context = [],
    ): void {
        if (empty($context['channel']) === false) {
            $message = '(' . strtoupper($context['channel']) . ') ' . $message;
        }

        $this->medoo->insert(
            'logs',
            [
                'machine' => $this->machine,
                'date' => $this->date,
                'level' => strtoupper($level),
                'user' => $this->user,
                'message' => $message,
            ],
        );
    }
}

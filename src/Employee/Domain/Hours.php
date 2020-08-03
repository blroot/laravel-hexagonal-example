<?php

declare(strict_types=1);

namespace Src\Employee\Domain;


final class Hours
{
    /**
     * @var int
     */
    private int $hours;

    public function __construct(int $hours)
    {
        $this->setHours($hours);
    }

    /**
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param int $hours
     */
    private function setHours(int $hours): void
    {
        if ($hours > 0) {
            $this->hours = $hours;
        } else {
            throw new IncorrectHours("");
        }
    }
}

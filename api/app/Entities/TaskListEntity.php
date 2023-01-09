<?php

declare(strict_types=1);


namespace App\Entities;


use DateTime;
use JsonSerializable;

class TaskListEntity implements JsonSerializable
{
    public function __construct(
        private string $id,
        private string $name,
        private string $ownerId,
        private array $tasks,
        private DateTime $createdAt
    ) {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'ownerId'   => $this->ownerId,
            'tasks'     => $this->tasks,
            'createdAt' => $this->createdAt->format(DATE_ATOM),
        ];
    }
}

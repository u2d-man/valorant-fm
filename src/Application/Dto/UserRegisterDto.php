<?php

declare(strict_types=1);

namespace App\Application\Dto;

use JsonSerializable;

class UserRegisterDto implements JsonSerializable
{
    public function __construct(
        private readonly int $id,
        private readonly string $loginId,
        private readonly string $password,
        private readonly string $name
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoginId(): string
    {
        return $this->loginId;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'loginId' => $this->loginId,
            'password' => $this->password,
            'name' => $this->name,
        ];
    }
}

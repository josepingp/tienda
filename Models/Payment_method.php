<?php

namespace Models;

class Payment_method {
    public function __construct(
        private string $id,
        private string $methodName,
    ) {}

    public function getId(): int 
    {
        return (int) $this->id;
    }
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function setMethodName(string $methodName): void
    {
        $this->methodName = $methodName;
    }

    public static function fromArray(array $data) :Payment_method
    {
        return new Payment_method(
            $data["id"],
            $data["method_name"]
        );
    }
}
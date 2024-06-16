<?php

namespace Models;

class ShippingAddress
{
    function __construct(
        private string $id, 
        private string $street,
        private string $number,
        private string $floor = '',
        private string $apartment = '',
        private string $postalCode,
        private string $city,
        private string $country,
        private string $userId,
        private bool $isMain,
    ){}

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): int
    {
        return (int) $this->number;
    }

    public function getFloor(): string
    {
        return $this->floor;
    }

    public function getApartment(): string
    {
        return $this->apartment;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getUserId(): string
    {
        return (string) $this->userId;
    }

    public function getIsMain(): bool
    {
        return $this->isMain;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function setFloor(string $floor): void
    {
        $this->floor = $floor;
    }

    public function setApartment(string $apartment): void
    {
        $this->apartment = $apartment;
    }

    public function setPostalCode(string $postalCode): void 
    {
        $this->postalCode = $postalCode;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function setIsMain(bool $isMain): void
    {
        $this->isMain = $isMain;
    }

    public function fromArray(array $data): ShippingAddress
    {
        return new ShippingAddress(
            $data['id'],
            $data['street'],
            $data['number'],
            $data['floor'],
            $data['apartment'],
            $data['postal_code'],
            $data['city'],
            $data['country'],
            $data['user_id'],
            $data['is_main']
        );
    }

}
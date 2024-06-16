<?php
namespace Models;

class User
{

    function __construct(
        private string $id,
        private string $name,
        private string $lastName1,
        private string $lastName2,
        private string $email,
        private string $birthDate,
        private string $dateRegistered,
        private string $pass,
        private string $rol = '3',
        private ?string $photo = null,
        private ?string $phoneNumber = null,
        private ?string $numCard = null,
    ) {
    }

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getLastName1(): string
    {
        return $this->lastName1;
    }

    public function setLastName1(string $lastName1)
    {
        $this->lastName1 = $lastName1;
    }

    public function getLastName2(): string
    {
        return $this->lastName2;
    }

    public function setLastName2(string $lastName2)
    {
        $this->lastName2 = $lastName2;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getPhone(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhone(string $phone)
    {
        $this->phoneNumber = $phone;
    }

    public function getDateRegistered(): string
    {
        return $this->dateRegistered;
    }

    public function setDateRegistered(string $dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo)
    {
        $this->photo = $photo;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function setPass(string $pass)
    {
        $this->pass = $pass;
    }

    public function getCardNumber(): ?string
    {
        return $this->numCard;
    }

    public function setCardNumber(?string $cardNumber)
    {
        $this->numCard = $cardNumber;
    }

    public function getRol(): int
    {
        return (int) $this->rol;
    }

    public function setRol(int $rol)
    {
        $this->rol = $rol;
    }

    public function getFullName()
    {
        return $this->getName(). ' ' .$this->getLastName1(). ' ' .$this->getLastName2();
    }

    public function takeInitials(): string
    {
        $string = explode(' ', $this->getName());
        
        $initials = '';
        
        foreach ($string as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
            $initials .= '. ';
        }
        
        return $initials;
    }

    public static function fromArray(array $data) :User
    {
        return new User(
            $data["id"],
            $data["name"],
            $data['last_name1'],
            $data['last_name2'],
            $data['email'],
            $data['birth_date'],
            $data['date_registered'],
            $data['password'],
            $data['role_id'],
            $data['photo_url'],
            $data['phone'],
            $data['card_number'],
        );
    }
}

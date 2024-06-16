<?php

namespace Models;

class Photo{

    public function __construct(
        public string $id,
        public string $url,
        public bool $isMain,
        public string $productId
        ){}

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function isMain(): bool
    {
        return $this->isMain;
    }

    public function setIsMain(bool $isMain): void
    {
        $this->isMain = $isMain;
    }

    public function getProductId(): int
    {
        return (int) $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public static function fromArray(array $data) :Photo
    {
        return new Photo(
            $data["id"],
            $data["url"],
            $data["is_main"],
            $data['product_id']
        );
    }
}
        
        
    
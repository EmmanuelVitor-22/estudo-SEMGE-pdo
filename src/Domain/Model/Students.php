<?php

namespace Emmanuel\Domain\Model;

class Students
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;
    private $phones = [];

    public function __construct(?int $id , string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    /**
     * @return array
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param Phone $phones
     * correspomde ao metodo addPhone
     */
//    public function setPhones($id, $area_code, $number): void
//    {
//        $this->phones[] = new Phone($id, $area_code, $number);
//    }
 public function setPhones($id, $area_code, $number): void
    {
        $this->phones[] = new Phone($id, $area_code, $number)   ;
    }


    //Metodo para definir o id caso no momento da criação não tenha sido definido
    // é o mesmo que "setId
    public function defineId(int $id):void
    {
        if (!is_null($this->id)){
            throw  new  \DomainException("Você só pode definir um ID por vez");
        }
        $this->id = $id;

    }

    public function changeName(string $nameUpdated): void
    {
        $this->name = $nameUpdated;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function age(): int
    {
        return $this->birthDate->diff(new \DateTimeImmutable())->y;

    }



}
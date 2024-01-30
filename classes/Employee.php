<?php

class Employee
{
    use Validation;

    private string $name;
    private int $age;
    private string $role;

    private int $minAge;
    private int $maxAge;

    /**
     * @param string $name
     * @param EmployeeRole $employeeRole
     * @param int $age
     * @throws Exception
     */
    public function __construct(string $name, EmployeeRole $employeeRole, int $age)
    {
        $this->setName($name);
        $this->setRole($employeeRole->value);
        [$minAge, $maxAge] = $this->ageHelper();
        $this->setMinAge($minAge);
        $this->setMaxAge($maxAge);
        $this->setAge($age);

    }

    /**
     * @return array
     */
    public function info(): array
    {
        $name = $this->getName();
        $age = $this->getAge();
        $role = $this->getRole();
        return [
            'name' => $name,
            'age' => $age,
            'role' => $role,
        ];
    }

    /**
     * @param string $name
     * @return void
     * @throws Exception
     */
    private function setName(string $name): void
    {
        $validated = $this->length($name);
        if (!$validated) {
            throw new Exception('Invalid name');
        }
        $this->name = $name;
    }

    /**
     * @return string
     */
    private function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $employeeRole
     * @return void
     */
    private function setRole(string $employeeRole): void
    {
        $this->role = $employeeRole;
    }

    /**
     * @return string
     */
    private function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param int $age
     * @return void
     * @throws Exception
     */
    private function setAge(int $age): void
    {
        $minAge = $this->getMinAge();
        if (!$this->min($age, $minAge)) {
            throw new Exception("Minimum age for this vacancy is $minAge");
        }
        $maxAge = $this->getMaxAge();
        if (!$this->max($age, $maxAge)) {
            throw new Exception("Maximum age for this vacancy is $maxAge");
        }

        $this->age = $age;
    }

    /**
     * @return int
     */
    private function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return int
     */
    private function getMaxAge(): int
    {
        return $this->maxAge;
    }

    /**
     * @param int $maxAge
     */
    private function setMaxAge(int $maxAge): void
    {
        $this->maxAge = $maxAge;
    }

    /**
     * @return int
     */
    private function getMinAge(): int
    {
        return $this->minAge;
    }

    /**
     * @param int $minAge
     */
    private function setMinAge(int $minAge): void
    {
        $this->minAge = $minAge;
    }

    private function ageHelper(): array
    {
        $role = $this->getRole();
        return match ($role) {
            EmployeeRole::CONSULTANT->value => [20, 40],
            EmployeeRole::LOADER->value => [18, 35],
            EmployeeRole::CASHIER->value => [18, 50],
            default => [18, 65],
        };
    }
}
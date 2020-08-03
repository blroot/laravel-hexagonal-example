<?php


namespace Src\Employee\Infrastructure;


use Src\Employee\Domain\Contracts\EmployeeRepository;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\EmployeeId;

class InMemoryEmployeeRepository implements EmployeeRepository
{
    private array $employees;

    public function __construct()
    {
        $this->employees = [];
    }

    public function search(EmployeeId $employeeId): array
    {
        $key = array_search($employeeId, $this->employees);
        return $this->employees[$key]->toArray();
    }

    public function save(EmployeeEntity $employee): void
    {
        array_push($this->employees, $employee);
    }
}

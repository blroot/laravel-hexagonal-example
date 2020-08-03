<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Employee\Application\UpdateSalaryUseCase;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\EmployeeId;
use Src\Employee\Domain\Hours;
use Src\Employee\Domain\Money;
use Src\Employee\Infrastructure\InMemoryEmployeeRepository;

class UpdateSalaryUseCaseTest extends TestCase
{
    private EmployeeId $employee_id;
    private Hours $employee_hours;
    private Money $employee_price_per_hour;
    private EmployeeEntity $employee;
    private InMemoryEmployeeRepository $repository;
    private UpdateSalaryUseCase $update_salary_use_case;

    public function test_se_actualiza_el_sueldo()
    {
        $this->givenAnEmployee();
        $this->givenAUseCase();

        $this->whenUpdateSalary();

        $this->thenEmployeeHasDifferentSalary();
    }

    public function givenAnEmployee(): void
    {
        $this->employee_id = new EmployeeId(1);
        $this->employee_hours = new Hours(8);
        $this->employee_price_per_hour = new Money(15);
        $this->employee = new EmployeeEntity($this->employee_id, $this->employee_hours, $this->employee_price_per_hour);
    }

    public function givenAUseCase(): void
    {
        $this->repository = new InMemoryEmployeeRepository();
        $this->update_salary_use_case = new UpdateSalaryUseCase($this->repository);
    }

    public function whenUpdateSalary(): void
    {
        $this->repository->save($this->employee);
        $this->update_salary_use_case->execute(1, 9);
    }

    public function thenEmployeeHasDifferentSalary(): void
    {
        $this->assertEquals(120, $this->employee->salary()->value());
    }
}

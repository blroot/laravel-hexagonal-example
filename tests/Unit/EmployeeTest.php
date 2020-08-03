<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Employee\Application\UpdateSalaryUseCase;
use Src\Employee\Domain\EmployeeEntity;
use Src\Employee\Domain\EmployeeId;
use Src\Employee\Domain\Hours;
use Src\Employee\Domain\Money;
use Src\Employee\Infrastructure\InMemoryEmployeeRepository;

class EmployeeTest extends TestCase
{
    public function test_se_actualiza_el_sueldo()
    {
        $employee_id = new EmployeeId(1);
        $employee_hours = new Hours(8);
        $employee_price_per_hour = new Money(15);
        $employee = new EmployeeEntity($employee_id, $employee_hours, $employee_price_per_hour);
        $repository = new InMemoryEmployeeRepository();
        $update_salary_use_case = new UpdateSalaryUseCase($repository);

        $repository->save($employee);
        $update_salary_use_case->execute(1, 9);


        $this->assertEquals(120, $employee->salary()->value());
    }
}

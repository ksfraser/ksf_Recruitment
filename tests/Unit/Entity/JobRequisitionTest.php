<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Recruitment\Entity\JobRequisition;

class JobRequisitionTest extends TestCase
{
    public function testCanCreateJobRequisition(): void
    {
        $req = new JobRequisition();
        $this->assertInstanceOf(JobRequisition::class, $req);
    }

    public function testCanSetAndGetTitle(): void
    {
        $req = new JobRequisition();
        $req->setTitle('Software Engineer');
        $this->assertEquals('Software Engineer', $req->getTitle());
    }

    public function testCanSetAndGetDepartment(): void
    {
        $req = new JobRequisition();
        $req->setDepartment('Engineering');
        $this->assertEquals('Engineering', $req->getDepartment());
    }

    public function testCanSetAndGetStatus(): void
    {
        $req = new JobRequisition();
        $this->assertEquals(JobRequisition::STATUS_DRAFT, $req->getStatus());
        $req->setStatus(JobRequisition::STATUS_OPEN);
        $this->assertEquals(JobRequisition::STATUS_OPEN, $req->getStatus());
    }

    public function testCanSetAndGetHeadcount(): void
    {
        $req = new JobRequisition();
        $req->setHeadcount(3);
        $this->assertEquals(3, $req->getHeadcount());
    }

    public function testCanSetAndGetFte(): void
    {
        $req = new JobRequisition();
        $req->setFte(0.5);
        $this->assertEquals(0.5, $req->getFte());
    }

    public function testCanSetAndGetSalary(): void
    {
        $req = new JobRequisition();
        $req->setSalaryMin(60000);
        $req->setSalaryMax(80000);
        $this->assertEquals(60000, $req->getSalaryMin());
        $this->assertEquals(80000, $req->getSalaryMax());
    }

    public function testIsOpen(): void
    {
        $req = new JobRequisition();
        $req->setStatus(JobRequisition::STATUS_OPEN);
        $this->assertTrue($req->isOpen());

        $req->setStatus(JobRequisition::STATUS_DRAFT);
        $this->assertFalse($req->isOpen());
    }

    public function testIsFilled(): void
    {
        $req = new JobRequisition();
        $req->setStatus(JobRequisition::STATUS_FILLED);
        $this->assertTrue($req->isFilled());

        $req->setStatus(JobRequisition::STATUS_OPEN);
        $this->assertFalse($req->isFilled());
    }

    public function testApprove(): void
    {
        $req = new JobRequisition();
        $req->approve(5);

        $this->assertEquals(5, $req->getApprovedById());
        $this->assertEquals(JobRequisition::STATUS_OPEN, $req->getStatus());
        $this->assertNotNull($req->getApprovedDate());
    }

    public function testClose(): void
    {
        $req = new JobRequisition();
        $req->setStatus(JobRequisition::STATUS_OPEN);
        $req->close();
        $this->assertEquals(JobRequisition::STATUS_CLOSED, $req->getStatus());
    }

    public function testSetAndGetId(): void
    {
        $req = new JobRequisition();
        $req->setId(10);
        $this->assertEquals(10, $req->getId());
    }

    public function testSetAndGetPositionType(): void
    {
        $req = new JobRequisition();
        $this->assertEquals('Full-time', $req->getPositionType());
        $req->setPositionType('Part-time');
        $this->assertEquals('Part-time', $req->getPositionType());
    }

    public function testSetAndGetHiringManagerId(): void
    {
        $req = new JobRequisition();
        $req->setHiringManagerId(25);
        $this->assertEquals(25, $req->getHiringManagerId());
    }

    public function testSetAndGetTargetStartDate(): void
    {
        $req = new JobRequisition();
        $req->setTargetStartDate('2026-06-01');
        $this->assertEquals('2026-06-01', $req->getTargetStartDate());
    }

    public function testSetAndGetSalaryCurrency(): void
    {
        $req = new JobRequisition();
        $this->assertEquals('CAD', $req->getSalaryCurrency());
        $req->setSalaryCurrency('USD');
        $this->assertEquals('USD', $req->getSalaryCurrency());
    }

    public function testFluentInterface(): void
    {
        $req = (new JobRequisition())
            ->setTitle('Fluent Requisition')
            ->setDepartment('Test')
            ->setHeadcount(2)
            ->setStatus(JobRequisition::STATUS_OPEN);

        $this->assertEquals('Fluent Requisition', $req->getTitle());
        $this->assertEquals('Test', $req->getDepartment());
        $this->assertEquals(2, $req->getHeadcount());
        $this->assertTrue($req->isOpen());
    }
}
<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Recruitment\Entity\JobRequisition;

class JobRequisitionTest extends TestCase
{
    public function testCanCreateRequisition(): void
    {
        $req = new JobRequisition();
        $this->assertInstanceOf(JobRequisition::class, $req);
    }

    public function testCanSetAndGetTitle(): void
    {
        $req = new JobRequisition();
        $req->setTitle('Software Developer');
        $this->assertEquals('Software Developer', $req->getTitle());
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
        $req->setStatus(JobRequisition::STATUS_OPEN);
        $this->assertEquals(JobRequisition::STATUS_OPEN, $req->getStatus());
    }

    public function testCanSetAndGetHiringManager(): void
    {
        $req = new JobRequisition();
        $req->setHiringManagerId(5);
        $this->assertEquals(5, $req->getHiringManagerId());
    }

    public function testCanCheckIsOpen(): void
    {
        $req = new JobRequisition();
        $req->setStatus(JobRequisition::STATUS_OPEN);
        $this->assertTrue($req->isOpen());
        
        $req->setStatus(JobRequisition::STATUS_FILLED);
        $this->assertFalse($req->isOpen());
    }

    public function testCanSetFteAndHeadcount(): void
    {
        $req = new JobRequisition();
        $req->setFte(1.0);
        $req->setHeadcount(2);
        $this->assertEquals(1.0, $req->getFte());
        $this->assertEquals(2, $req->getHeadcount());
    }
}
<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Recruitment\Entity\Candidate;

class CandidateTest extends TestCase
{
    public function testCanCreateCandidate(): void
    {
        $candidate = new Candidate();
        $this->assertInstanceOf(Candidate::class, $candidate);
    }

    public function testCanSetAndGetFirstName(): void
    {
        $candidate = new Candidate();
        $candidate->setFirstName('John');
        $this->assertEquals('John', $candidate->getFirstName());
    }

    public function testCanSetAndGetLastName(): void
    {
        $candidate = new Candidate();
        $candidate->setLastName('Doe');
        $this->assertEquals('Doe', $candidate->getLastName());
    }

    public function testGetFullName(): void
    {
        $candidate = new Candidate();
        $candidate->setFirstName('John');
        $candidate->setLastName('Doe');
        $this->assertEquals('John Doe', $candidate->getFullName());
    }

    public function testCanSetAndGetEmail(): void
    {
        $candidate = new Candidate();
        $candidate->setEmail('john@example.com');
        $this->assertEquals('john@example.com', $candidate->getEmail());
    }

    public function testCanSetAndGetPhone(): void
    {
        $candidate = new Candidate();
        $candidate->setPhone('555-1234');
        $this->assertEquals('555-1234', $candidate->getPhone());
    }

    public function testCanSetAndGetStatus(): void
    {
        $candidate = new Candidate();
        $this->assertEquals(Candidate::STATUS_ACTIVE, $candidate->getStatus());
        $candidate->setStatus(Candidate::STATUS_INTERVIEW);
        $this->assertEquals(Candidate::STATUS_INTERVIEW, $candidate->getStatus());
    }

    public function testCanSetAndGetSource(): void
    {
        $candidate = new Candidate();
        $this->assertEquals(Candidate::SOURCE_DIRECT, $candidate->getSource());
        $candidate->setSource(Candidate::SOURCE_LINKEDIN);
        $this->assertEquals(Candidate::SOURCE_LINKEDIN, $candidate->getSource());
    }

    public function testIsActive(): void
    {
        $candidate = new Candidate();
        $candidate->setStatus(Candidate::STATUS_ACTIVE);
        $this->assertTrue($candidate->isActive());

        $candidate->setStatus(Candidate::STATUS_REJECTED);
        $this->assertFalse($candidate->isActive());
    }

    public function testIsHired(): void
    {
        $candidate = new Candidate();
        $candidate->setStatus(Candidate::STATUS_HIRED);
        $this->assertTrue($candidate->isHired());

        $candidate->setStatus(Candidate::STATUS_INTERVIEW);
        $this->assertFalse($candidate->isHired());
    }

    public function testIsInPipeline(): void
    {
        $candidate = new Candidate();

        $candidate->setStatus(Candidate::STATUS_SCREENING);
        $this->assertTrue($candidate->isInPipeline());

        $candidate->setStatus(Candidate::STATUS_INTERVIEW);
        $this->assertTrue($candidate->isInPipeline());

        $candidate->setStatus(Candidate::STATUS_OFFER);
        $this->assertTrue($candidate->isInPipeline());

        $candidate->setStatus(Candidate::STATUS_ACTIVE);
        $this->assertFalse($candidate->isInPipeline());
    }

    public function testReject(): void
    {
        $candidate = new Candidate();
        $candidate->reject('Not qualified');

        $this->assertEquals(Candidate::STATUS_REJECTED, $candidate->getStatus());
        $this->assertEquals('Not qualified', $candidate->getRejectionReason());
        $this->assertNotNull($candidate->getRejectedDate());
    }

    public function testHire(): void
    {
        $candidate = new Candidate();
        $candidate->hire(100);

        $this->assertEquals(Candidate::STATUS_HIRED, $candidate->getStatus());
        $this->assertEquals(100, $candidate->getEmployeeId());
    }

    public function testSetAndGetRequisitionId(): void
    {
        $candidate = new Candidate();
        $candidate->setRequisitionId(5);
        $this->assertEquals(5, $candidate->getRequisitionId());
    }

    public function testSetAndGetAppliedDate(): void
    {
        $candidate = new Candidate();
        $candidate->setAppliedDate('2026-05-01');
        $this->assertEquals('2026-05-01', $candidate->getAppliedDate());
    }

    public function testSetAndGetNotes(): void
    {
        $candidate = new Candidate();
        $candidate->setNotes('Interview notes');
        $this->assertEquals('Interview notes', $candidate->getNotes());
    }

    public function testFluentInterface(): void
    {
        $candidate = (new Candidate())
            ->setFirstName('Jane')
            ->setLastName('Smith')
            ->setEmail('jane@company.com')
            ->setStatus(Candidate::STATUS_SCREENING)
            ->setSource(Candidate::SOURCE_REFERRAL);

        $this->assertEquals('Jane', $candidate->getFirstName());
        $this->assertEquals('Smith', $candidate->getLastName());
        $this->assertEquals('Jane Smith', $candidate->getFullName());
        $this->assertEquals(Candidate::STATUS_SCREENING, $candidate->getStatus());
        $this->assertEquals(Candidate::SOURCE_REFERRAL, $candidate->getSource());
    }

    public function testSetAndGetId(): void
    {
        $candidate = new Candidate();
        $candidate->setId(25);
        $this->assertEquals(25, $candidate->getId());
    }
}
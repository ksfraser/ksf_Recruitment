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

    public function testCanSetAndGetName(): void
    {
        $candidate = new Candidate();
        $candidate->setFirstName('John');
        $candidate->setLastName('Doe');
        $this->assertEquals('John', $candidate->getFirstName());
        $this->assertEquals('Doe', $candidate->getLastName());
    }

    public function testCanSetAndGetEmail(): void
    {
        $candidate = new Candidate();
        $candidate->setEmail('john@example.com');
        $this->assertEquals('john@example.com', $candidate->getEmail());
    }

    public function testCanSetAndGetSource(): void
    {
        $candidate = new Candidate();
        $candidate->setSource(Candidate::SOURCE_REFERRAL);
        $this->assertEquals(Candidate::SOURCE_REFERRAL, $candidate->getSource());
    }

    public function testCanSetAndGetStatus(): void
    {
        $candidate = new Candidate();
        $candidate->setStatus(Candidate::STATUS_SCREENING);
        $this->assertEquals(Candidate::STATUS_SCREENING, $candidate->getStatus());
    }

    public function testCanCheckIsActive(): void
    {
        $candidate = new Candidate();
        $candidate->setStatus(Candidate::STATUS_ACTIVE);
        $this->assertTrue($candidate->isActive());
    }
}
<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Recruitment\Entity;

use Ksfraser\Recruitment\Entity\JobApplication;
use PHPUnit\Framework\TestCase;

class JobApplicationTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $app = new JobApplication();

        $this->assertNull($app->getId());
        $this->assertSame(0, $app->getJobId());
        $this->assertSame(0, $app->getApplicantId());
        $this->assertSame('draft', $app->getStatus());
        $this->assertNull($app->getAssignedTo());
        $this->assertNull($app->getAppliedAt());
    }

    /**
     * @covers Ksfraser\Recruitment\Entity\JobApplication::setId
     */
    public function testSetId(): void
    {
        $app = new JobApplication();
        $result = $app->setId(1);

        $this->assertInstanceOf(JobApplication::class, $result);
        $this->assertSame(1, $app->getId());
    }

    /**
     * @covers Ksfraser\Recruitment\Entity\JobApplication::STATUS_SUBMITTED
     */
    public function testStatusConstants(): void
    {
        $this->assertSame('draft', JobApplication::STATUS_DRAFT);
        $this->assertSame('submitted', JobApplication::STATUS_SUBMITTED);
        $this->assertSame('reviewing', JobApplication::STATUS_REVIEWING);
        $this->assertSame('interview', JobApplication::STATUS_INTERVIEW);
        $this->assertSame('offer', JobApplication::STATUS_OFFER);
        $this->assertSame('hired', JobApplication::STATUS_HIRED);
        $this->assertSame('rejected', JobApplication::STATUS_REJECTED);
    }

    /**
     * @covers Ksfraser\Recruitment\Entity\JobApplication::setRating
     */
    public function testSetRating(): void
    {
        $app = new JobApplication();
        $result = $app->setRating(4.5);

        $this->assertInstanceOf(JobApplication::class, $result);
        $this->assertSame(4.5, $app->getRating());
    }
}
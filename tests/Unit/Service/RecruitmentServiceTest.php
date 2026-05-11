<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Recruitment\Service;

use Ksfraser\Recruitment\Entity\JobOpening;
use Ksfraser\Recruitment\Entity\JobApplication;
use Ksfraser\Recruitment\Service\RecruitmentService;
use PHPUnit\Framework\TestCase;

class RecruitmentServiceTest extends TestCase
{
    private RecruitmentService $service;

    protected function setUp(): void
    {
        $this->service = new RecruitmentService();
    }

    /**
     * @covers Ksfraser\Recruitment\Service\RecruitmentService::createOpening
     */
    public function testCreateOpening(): void
    {
        $opening = $this->service->createOpening([
            'id' => 1,
            'title' => 'Engineer',
            'department' => 'Engineering',
            'status' => 'open',
        ]);

        $this->assertInstanceOf(JobOpening::class, $opening);
        $this->assertSame('Engineer', $opening->getTitle());
        $this->assertTrue($opening->isOpen());
    }

    /**
     * @covers Ksfraser\Recruitment\Service\RecruitmentService::getOpening
     */
    public function testGetOpening(): void
    {
        $this->service->createOpening(['id' => 10, 'title' => 'FindMe']);

        $opening = $this->service->getOpening(10);

        $this->assertNotNull($opening);
        $this->assertSame('FindMe', $opening->getTitle());
    }

    /**
     * @covers Ksfraser\Recruitment\Service\RecruitmentService::submitApplication
     */
    public function testSubmitApplication(): void
    {
        $app = $this->service->submitApplication([
            'id' => 1,
            'job_id' => 10,
            'applicant_id' => 100,
        ]);

        $this->assertInstanceOf(JobApplication::class, $app);
        $this->assertSame(10, $app->getJobId());
        $this->assertSame(100, $app->getApplicantId());
        $this->assertSame('submitted', $app->getStatus());
    }

    /**
     * @covers Ksfraser\Recruitment\Service\RecruitmentService::advanceApplication
     */
    public function testAdvanceApplication(): void
    {
        $this->service->submitApplication(['id' => 20, 'job_id' => 1, 'applicant_id' => 1]);

        $updated = $this->service->advanceApplication(20, 'interview');

        $this->assertNotNull($updated);
        $this->assertSame('interview', $updated->getStatus());
    }

    /**
     * @covers Ksfraser\Recruitment\Service\RecruitmentService::rateApplication
     */
    public function testRateApplication(): void
    {
        $this->service->submitApplication(['id' => 30, 'job_id' => 1, 'applicant_id' => 1]);

        $rated = $this->service->rateApplication(30, 4.5);

        $this->assertNotNull($rated);
        $this->assertSame(4.5, $rated->getRating());
    }
}
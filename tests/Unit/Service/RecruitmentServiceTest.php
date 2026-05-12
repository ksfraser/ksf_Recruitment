<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Ksfraser\Recruitment\Service\RecruitmentService;
use Ksfraser\Recruitment\Entity\JobOpening;
use Ksfraser\Recruitment\Entity\JobApplication;

class RecruitmentServiceTest extends TestCase
{
    private RecruitmentService $service;

    protected function setUp(): void
    {
        $this->service = new RecruitmentService();
    }

    public function testCanCreateRecruitmentService(): void
    {
        $this->assertInstanceOf(RecruitmentService::class, $this->service);
    }

    public function testCreateOpening(): void
    {
        $opening = $this->service->createOpening([
            'title' => 'Software Developer',
            'department' => 'IT',
            'location' => 'Vancouver',
        ]);

        $this->assertInstanceOf(JobOpening::class, $opening);
        $this->assertEquals('Software Developer', $opening->getTitle());
        $this->assertEquals('IT', $opening->getDepartment());
        $this->assertEquals('Vancouver', $opening->getLocation());
    }

    public function testGetOpening(): void
    {
        $opening = $this->service->createOpening(['title' => 'Test Opening']);
        $found = $this->service->getOpening($opening->getId());

        $this->assertNotNull($found);
        $this->assertEquals($opening->getId(), $found->getId());
    }

    public function testGetNonExistentOpening(): void
    {
        $found = $this->service->getOpening(9999);
        $this->assertNull($found);
    }

    public function testGetOpeningsByStatus(): void
    {
        $this->service->createOpening([
            'title' => 'Open Position',
            'status' => JobOpening::STATUS_OPEN,
        ]);
        $this->service->createOpening([
            'title' => 'Draft Position',
            'status' => JobOpening::STATUS_DRAFT,
        ]);
        $this->service->createOpening([
            'title' => 'Another Open',
            'status' => JobOpening::STATUS_OPEN,
        ]);

        $open = $this->service->getOpenings(JobOpening::STATUS_OPEN);
        $drafts = $this->service->getOpenings(JobOpening::STATUS_DRAFT);

        $this->assertCount(2, $open);
        $this->assertCount(1, $drafts);
    }

    public function testGetAllOpenings(): void
    {
        $this->service->createOpening(['title' => 'Position 1']);
        $this->service->createOpening(['title' => 'Position 2']);

        $all = $this->service->getOpenings();
        $this->assertCount(2, $all);
    }

    public function testSubmitApplication(): void
    {
        $application = $this->service->submitApplication([
            'job_id' => 5,
            'applicant_id' => 10,
        ]);

        $this->assertInstanceOf(JobApplication::class, $application);
        $this->assertEquals(5, $application->getJobId());
        $this->assertEquals(10, $application->getApplicantId());
        $this->assertEquals(JobApplication::STATUS_SUBMITTED, $application->getStatus());
        $this->assertNotNull($application->getAppliedAt());
    }

    public function testGetApplication(): void
    {
        $app = $this->service->submitApplication([
            'job_id' => 1,
            'applicant_id' => 1,
        ]);

        $found = $this->service->getApplication($app->getId());
        $this->assertNotNull($found);
        $this->assertEquals($app->getId(), $found->getId());
    }

    public function testAdvanceApplication(): void
    {
        $app = $this->service->submitApplication([
            'job_id' => 1,
            'applicant_id' => 1,
        ]);

        $advanced = $this->service->advanceApplication(
            $app->getId(),
            JobApplication::STATUS_INTERVIEW
        );

        $this->assertNotNull($advanced);
        $this->assertEquals(JobApplication::STATUS_INTERVIEW, $advanced->getStatus());
    }

    public function testAdvanceNonExistentApplication(): void
    {
        $advanced = $this->service->advanceApplication(9999, JobApplication::STATUS_INTERVIEW);
        $this->assertNull($advanced);
    }

    public function testAssignRecruiter(): void
    {
        $opening = $this->service->createOpening(['title' => 'Test Opening']);
        $assigned = $this->service->assignRecruiter($opening->getId(), 15);

        $this->assertNotNull($assigned);
        $this->assertEquals(15, $assigned->getAssignedRecruiterId());
    }

    public function testAssignRecruiterToNonExistentOpening(): void
    {
        $assigned = $this->service->assignRecruiter(9999, 15);
        $this->assertNull($assigned);
    }

    public function testRateApplication(): void
    {
        $app = $this->service->submitApplication([
            'job_id' => 1,
            'applicant_id' => 1,
        ]);

        $rated = $this->service->rateApplication($app->getId(), 4.5);

        $this->assertNotNull($rated);
        $this->assertEquals(4.5, $rated->getRating());
    }

    public function testRateNonExistentApplication(): void
    {
        $rated = $this->service->rateApplication(9999, 5.0);
        $this->assertNull($rated);
    }

    public function testMultipleApplicationsForSameJob(): void
    {
        $this->service->submitApplication(['job_id' => 1, 'applicant_id' => 1]);
        $this->service->submitApplication(['job_id' => 1, 'applicant_id' => 2]);
        $this->service->submitApplication(['job_id' => 1, 'applicant_id' => 3]);

        $applications = $this->service->getApplication(1);
        $this->assertNotNull($applications);
    }
}
<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Service;

use Ksfraser\Recruitment\Entity\JobApplication;
use Ksfraser\Recruitment\Entity\JobOpening;

class RecruitmentService
{
    private array $openings = [];
    private array $applications = [];

    public function createOpening(array $data): JobOpening
    {
        $opening = new JobOpening($data);
        if (!isset($data['id'])) {
            $data['id'] = count($this->openings) + 1;
            $opening = new JobOpening($data);
        }
        $this->openings[$opening->getId()] = $opening;
        return $opening;
    }

    public function getOpening(int $id): ?JobOpening
    {
        return $this->openings[$id] ?? null;
    }

    public function getOpenings(?string $status = null): array
    {
        if ($status === null) {
            return array_values($this->openings);
        }
        return array_values(array_filter(
            $this->openings,
            fn($o) => $o->getStatus() === $status
        ));
    }

    public function submitApplication(array $data): JobApplication
    {
        $app = new JobApplication();
        $id = $data['id'] ?? count($this->applications) + 1;
        $app->setId($id);
        $app->setJobId($data['job_id'] ?? 0);
        $app->setApplicantId($data['applicant_id'] ?? 0);
        $app->setStatus(JobApplication::STATUS_SUBMITTED);
        $app->setAppliedAt(date('Y-m-d H:i:s'));

        $this->applications[$id] = $app;
        return $app;
    }

    public function getApplication(int $id): ?JobApplication
    {
        return $this->applications[$id] ?? null;
    }

    public function advanceApplication(int $id, string $newStatus): ?JobApplication
    {
        $app = $this->getApplication($id);
        if ($app === null) return null;

        $app->setStatus($newStatus);
        $this->applications[$id] = $app;
        return $app;
    }

    public function assignRecruiter(int $openingId, int $recruiterId): ?JobOpening
    {
        $opening = $this->getOpening($openingId);
        if ($opening === null) return null;

        $opening->setAssignedRecruiterId($recruiterId);
        return $opening;
    }

    public function rateApplication(int $id, float $rating): ?JobApplication
    {
        $app = $this->getApplication($id);
        if ($app === null) return null;

        $app->setRating($rating);
        return $app;
    }
}
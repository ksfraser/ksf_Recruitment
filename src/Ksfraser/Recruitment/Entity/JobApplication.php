<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Entity;

class JobApplication
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_REVIEWING = 'reviewing';
    public const STATUS_INTERVIEW = 'interview';
    public const STATUS_OFFER = 'offer';
    public const STATUS_HIRED = 'hired';
    public const STATUS_REJECTED = 'rejected';

    private ?int $id = null;
    private int $jobId = 0;
    private int $applicantId = 0;
    private string $status = self::STATUS_DRAFT;
    private ?int $assignedTo = null;
    private ?string $appliedAt = null;
    private ?string $reviewNotes = null;
    private float $rating = 0;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getJobId(): int { return $this->jobId; }
    public function setJobId(int $jobId): self { $this->jobId = $jobId; return $this; }
    public function getApplicantId(): int { return $this->applicantId; }
    public function setApplicantId(int $applicantId): self { $this->applicantId = $applicantId; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getAssignedTo(): ?int { return $this->assignedTo; }
    public function setAssignedTo(?int $assignedTo): self { $this->assignedTo = $assignedTo; return $this; }
    public function getAppliedAt(): ?string { return $this->appliedAt; }
    public function setAppliedAt(?string $appliedAt): self { $this->appliedAt = $appliedAt; return $this; }
    public function getReviewNotes(): ?string { return $this->reviewNotes; }
    public function setReviewNotes(?string $reviewNotes): self { $this->reviewNotes = $reviewNotes; return $this; }
    public function getRating(): float { return $this->rating; }
    public function setRating(float $rating): self { $this->rating = $rating; return $this; }
}
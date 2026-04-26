<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Entity;

class JobRequisition
{
    public const STATUS_DRAFT = 'Draft';
    public const STATUS_OPEN = 'Open';
    public const STATUS_ON_HOLD = 'On Hold';
    public const STATUS_CANCELLED = 'Cancelled';
    public const STATUS_FILLED = 'Filled';
    public const STATUS_CLOSED = 'Closed';

    private ?int $id = null;
    private string $title = '';
    private string $department = '';
    private string $description = '';
    private ?int $jobDescriptionId = null;
    private float $fte = 1.0;
    private int $headcount = 1;
    private string $status = self::STATUS_DRAFT;
    private ?int $hiringManagerId = null;
    private ?int $hrContactId = null;
    private string $positionType = 'Full-time';
    private ?string $targetStartDate = null;
    private ?string $approvedDate = null;
    private ?int $approvedById = null;
    private float $salaryMin = 0;
    private float $salaryMax = 0;
    private ?string $salaryCurrency = 'CAD';

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDepartment(): string { return $this->department; }
    public function setDepartment(string $department): self { $this->department = $department; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getJobDescriptionId(): ?int { return $this->jobDescriptionId; }
    public function setJobDescriptionId(?int $jobDescriptionId): self { $this->jobDescriptionId = $jobDescriptionId; return $this; }
    public function getFte(): float { return $this->fte; }
    public function setFte(float $fte): self { $this->fte = $fte; return $this; }
    public function getHeadcount(): int { return $this->headcount; }
    public function setHeadcount(int $headcount): self { $this->headcount = $headcount; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getHiringManagerId(): ?int { return $this->hiringManagerId; }
    public function setHiringManagerId(?int $hiringManagerId): self { $this->hiringManagerId = $hiringManagerId; return $this; }
    public function getHrContactId(): ?int { return $this->hrContactId; }
    public function setHrContactId(?int $hrContactId): self { $this->hrContactId = $hrContactId; return $this; }
    public function getPositionType(): string { return $this->positionType; }
    public function setPositionType(string $positionType): self { $this->positionType = $positionType; return $this; }
    public function getTargetStartDate(): ?string { return $this->targetStartDate; }
    public function setTargetStartDate(?string $targetStartDate): self { $this->targetStartDate = $targetStartDate; return $this; }
    public function getApprovedDate(): ?string { return $this->approvedDate; }
    public function setApprovedDate(?string $approvedDate): self { $this->approvedDate = $approvedDate; return $this; }
    public function getApprovedById(): ?int { return $this->approvedById; }
    public function setApprovedById(?int $approvedById): self { $this->approvedById = $approvedById; return $this; }
    public function getSalaryMin(): float { return $this->salaryMin; }
    public function setSalaryMin(float $salaryMin): self { $this->salaryMin = $salaryMin; return $this; }
    public function getSalaryMax(): float { return $this->salaryMax; }
    public function setSalaryMax(float $salaryMax): self { $this->salaryMax = $salaryMax; return $this; }
    public function getSalaryCurrency(): ?string { return $this->salaryCurrency; }
    public function setSalaryCurrency(?string $salaryCurrency): self { $this->salaryCurrency = $salaryCurrency; return $this; }

    public function isOpen(): bool
    {
        return $this->status === self::STATUS_OPEN;
    }

    public function isFilled(): bool
    {
        return $this->status === self::STATUS_FILLED;
    }

    public function approve(int $approverId): void
    {
        $this->approvedDate = date('Y-m-d');
        $this->approvedById = $approverId;
        $this->status = self::STATUS_OPEN;
    }

    public function close(): void
    {
        $this->status = self::STATUS_CLOSED;
    }
}
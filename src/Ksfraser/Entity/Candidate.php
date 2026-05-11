<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Entity;

class Candidate
{
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_SCREENING = 'Screening';
    public const STATUS_INTERVIEW = 'Interview';
    public const STATUS_OFFER = 'Offer';
    public const STATUS_HIRED = 'Hired';
    public const STATUS_REJECTED = 'Rejected';
    public const STATUS_WITHDRAWN = 'Withdrawn';

    public const SOURCE_INDED = 'Indeed';
    public const SOURCE_LINKEDIN = 'LinkedIn';
    public const SOURCE_REFERRAL = 'Referral';
    public const SOURCE_AGENCY = 'Agency';
    public const SOURCE_DIRECT = 'Direct';
    public const SOURCE_OTHER = 'Other';

    private ?int $id = null;
    private string $firstName = '';
    private string $lastName = '';
    private ?string $email = null;
    private ?string $phone = null;
    private string $status = self::STATUS_ACTIVE;
    private string $source = self::SOURCE_DIRECT;
    private ?int $requisitionId = null;
    private ?int $employeeId = null;
    private ?string $appliedDate = null;
    private ?string $rejectedDate = null;
    private ?string $rejectionReason = null;
    private string $notes = '';

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getFirstName(): string { return $this->firstName; }
    public function setFirstName(string $firstName): self { $this->firstName = $firstName; return $this; }
    public function getLastName(): string { return $this->lastName; }
    public function setLastName(string $lastName): self { $this->lastName = $lastName; return $this; }
    public function getFullName(): string { return trim($this->firstName . ' ' . $this->lastName); }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }
    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getSource(): string { return $this->source; }
    public function setSource(string $source): self { $this->source = $source; return $this; }
    public function getRequisitionId(): ?int { return $this->requisitionId; }
    public function setRequisitionId(?int $requisitionId): self { $this->requisitionId = $requisitionId; return $this; }
    public function getEmployeeId(): ?int { return $this->employeeId; }
    public function setEmployeeId(?int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getAppliedDate(): ?string { return $this->appliedDate; }
    public function setAppliedDate(?string $appliedDate): self { $this->appliedDate = $appliedDate; return $this; }
    public function getRejectedDate(): ?string { return $this->rejectedDate; }
    public function setRejectedDate(?string $rejectedDate): self { $this->rejectedDate = $rejectedDate; return $this; }
    public function getRejectionReason(): ?string { return $this->rejectionReason; }
    public function setRejectionReason(?string $rejectionReason): self { $this->rejectionReason = $rejectionReason; return $this; }
    public function getNotes(): string { return $this->notes; }
    public function setNotes(string $notes): self { $this->notes = $notes; return $this; }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isHired(): bool
    {
        return $this->status === self::STATUS_HIRED;
    }

    public function isInPipeline(): bool
    {
        return in_array($this->status, [
            self::STATUS_SCREENING,
            self::STATUS_INTERVIEW,
            self::STATUS_OFFER,
        ], true);
    }

    public function reject(string $reason): void
    {
        $this->status = self::STATUS_REJECTED;
        $this->rejectedDate = date('Y-m-d');
        $this->rejectionReason = $reason;
    }

    public function hire(int $employeeId): void
    {
        $this->status = self::STATUS_HIRED;
        $this->employeeId = $employeeId;
    }
}
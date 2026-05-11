<?php

declare(strict_types=1);

namespace Ksfraser\Recruitment\Entity;

class JobOpening
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_OPEN = 'open';
    public const STATUS_PAUSED = 'paused';
    public const STATUS_CLOSED = 'closed';

    private ?int $id = null;
    private string $title = '';
    private string $department = '';
    private string $location = '';
    private string $type = 'Full-time';
    private string $description = '';
    private string $requirements = '';
    private string $status = self::STATUS_DRAFT;
    private ?int $hiringManagerId = null;
    private ?int $assignedRecruiterId = null;
    private array $stages = [];
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->title = $data['title'] ?? '';
        $this->department = $data['department'] ?? '';
        $this->location = $data['location'] ?? '';
        $this->type = $data['type'] ?? 'Full-time';
        $this->description = $data['description'] ?? '';
        $this->requirements = $data['requirements'] ?? '';
        $this->status = $data['status'] ?? self::STATUS_DRAFT;
        $this->hiringManagerId = $data['hiring_manager_id'] ?? null;
        $this->assignedRecruiterId = $data['assigned_recruiter_id'] ?? null;
        $this->stages = $data['stages'] ?? [];
        $this->createdAt = new \DateTime($data['created_at'] ?? 'now');
        $this->updatedAt = new \DateTime($data['updated_at'] ?? 'now');
    }

    public function getId(): ?int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDepartment(): string { return $this->department; }
    public function setDepartment(string $department): self { $this->department = $department; return $this; }
    public function getLocation(): string { return $this->location; }
    public function setLocation(string $location): self { $this->location = $location; return $this; }
    public function getType(): string { return $this->type; }
    public function setType(string $type): self { $this->type = $type; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getHiringManagerId(): ?int { return $this->hiringManagerId; }
    public function setHiringManagerId(?int $id): self { $this->hiringManagerId = $id; return $this; }
    public function getAssignedRecruiterId(): ?int { return $this->assignedRecruiterId; }
    public function setAssignedRecruiterId(?int $id): self { $this->assignedRecruiterId = $id; return $this; }
    public function getCreatedAt(): \DateTime { return $this->createdAt; }
    public function getUpdatedAt(): \DateTime { return $this->updatedAt; }
    public function isOpen(): bool { return $this->status === self::STATUS_OPEN; }
}
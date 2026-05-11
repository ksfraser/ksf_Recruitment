<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Recruitment\Entity;

use Ksfraser\Recruitment\Entity\JobOpening;
use PHPUnit\Framework\TestCase;

class JobOpeningTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $opening = new JobOpening();

        $this->assertNull($opening->getId());
        $this->assertSame('', $opening->getTitle());
        $this->assertSame('draft', $opening->getStatus());
        $this->assertNull($opening->getHiringManagerId());
    }

    /**
     * @covers Ksfraser\Recruitment\Entity\JobOpening::__construct
     */
    public function testConstructWithData(): void
    {
        $opening = new JobOpening([
            'id' => 1,
            'title' => 'Engineer',
            'department' => 'Engineering',
            'status' => 'open',
        ]);

        $this->assertSame(1, $opening->getId());
        $this->assertSame('Engineer', $opening->getTitle());
        $this->assertSame('Engineering', $opening->getDepartment());
        $this->assertSame('open', $opening->getStatus());
    }

    /**
     * @covers Ksfraser\Recruitment\Entity\JobOpening::isOpen
     */
    public function testIsOpen(): void
    {
        $opening = new JobOpening(['status' => 'open']);
        $this->assertTrue($opening->isOpen());

        $opening->setStatus('closed');
        $this->assertFalse($opening->isOpen());
    }
}
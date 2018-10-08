<?php

namespace App\Tests\Repository;

use App\Entity\Staff;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

class StaffTest extends TestCase
{
    public function testEmailIsSavedInLowerCase(): void
    {
        $email = 'Cezar.Pendarovski@ROSLIN.ed.ac.uk';
        $staff = new Staff();
        $staff->setUsername('cpendaro');
        $staff->setFirstName('Cezar');
        $staff->setLastName('Pendarovski');
        $staff->setHomeProgram('CTLGH');
        $staff->setEmail($email);

        $staffRepository = $this->createMock(ObjectRepository::class);
        $staffRepository->expects($this->any())
            ->method('find')
            ->willReturn($staff);

        $objectManager = $this->createMock(ObjectManager::class);
        // $objectManager = $this->getMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($staffRepository);

        $this->assertEquals(strtolower($staff->getEmail()), $staff->getEmail());
        $this->assertNotEquals($email, $staff->getEmail());
    }
}

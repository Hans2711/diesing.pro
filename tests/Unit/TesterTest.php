<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Testobject;
use App\Models\Testinstance;
use App\Models\Testrun;

class TesterTest extends TestCase
{
    // tests/Unit/TestobjectTest.php
    public function testCreateTestobject()
    {
        $testobject = new Testobject();
        $this->assertInstanceOf(Testobject::class, $testobject);
    }

    // tests/Unit/TestrunTest.php
    public function testCreateTestrun()
    {
        $testrun = new Testrun();
        $this->assertInstanceOf(Testrun::class, $testrun);
    }

    // tests/Unit/TestinstanceTest.php
    public function testCreateTestinstance()
    {
        $Testinstance = new Testinstance();
        $this->assertInstanceOf(Testinstance::class, $Testinstance);
    }
}


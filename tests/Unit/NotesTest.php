<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Note;

class NotesTest extends TestCase
{
    // tests/Unit/NotesTest.php
    public function testCreateNote()
    {
        $note = new Note();

        $this->assertInstanceOf(Note::class, $note);
    }

    // tests/Unit/NotesTest.php
    public function testNoteShareIsDisabled()
    {
        $note = new Note();

        $this->assertEquals(0, $note->share);
    }
}



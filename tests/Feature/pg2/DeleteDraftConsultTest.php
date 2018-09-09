<?php
/**
 * Created by Teepop Ueangsawat
 * Description=> Test case for get list of user function
 * Unit Test ID=> UTC-07
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeleteDraftConsultTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    public function testDeleteExistingDraftConsult()
    {
        $response = $this->json('GET', 'api/consults/aaaaaaaaaaaaa/delete');

        $response->assertJson([
            "message" => "success"
        ]);
    }

    public function testDeleteNotExistingConsult()
    {
        $response = $this->json('GET', 'api/consults/abcdef/delete');

        $response->assertJson([
            "consult_id" => ["not_exist"]
        ]);
    }

    public function testDeleteNotDraftConsult()
    {
        $response = $this->json('GET', 'api/consults/bbbbbbbbbbbbb/delete');

        $response->assertJson([
            "error" => "not_draft_consult"
        ]);
    }
}

<?php
/**
 * Created by Teepop Ueangsawat
 * Description: Test case for add user function
 * Unit Test ID: UTC-05
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class ReplyConsultTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     *  All Valid (1)
     */
    public function testReplyConsultWithAllValidInput()
    {
        $response = $this->json('POST', 'api/consults/bbbbbbbbbbbbb/reply', [
            'consult_order' => 'consult order test'
        ]);

        $response->assertJson([
            'message' => 'success'
        ]);
    }

    public function testReplyConsultWithNotExistingConsult()
    {
        $response = $this->json('POST', 'api/consults/abcdef/reply', [
            'consult_order' => 'consult order test'
        ]);

        $response->assertJson([
            'consult_id' => ['not_exist']
        ]);
    }

    public function testReplyConsultWithNoConsultOrder()
    {
        $response = $this->json('POST', 'api/consults/bbbbbbbbbbbbb/reply', [

        ]);

        $response->assertJson([
            'consult_order' => ['required']
        ]);
    }

    public function testReplyConsultWithNotPendingConsult()
    {
        $response = $this->json('POST', 'api/consults/aaaaaaaaaaaaa/reply', [
            'consult_order' => 'consult order test'
        ]);

        $response->assertJson([
            'error' => 'not_pending_consult'
        ]);
    }

}

<?php

namespace Tests\Unit;

use App\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_currency_list()
    {
        $response = $this->get('api/currencies');
        $response->assertTrue(true);
        // $response->assertStatus(200);

    }

    public function test_database()
    {
        $this->assertDatabaseMissing('tbl_currencies', [
            'common_name'=> 'British pound'
        ]);
    }

    public function testNumberOfCurrencies()
    {
        $number = Currency::all()->count();
        return $this->assertEquals(160, $number);
    }
   

}

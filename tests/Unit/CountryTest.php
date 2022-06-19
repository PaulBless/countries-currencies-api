<?php

namespace Tests\Unit;

use App\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;


class CountryTest extends TestCase {

    use RefreshDatabase;

    public function test_list_of_countries() {

        $this->json('get', 'api/countries')
         ->assertStatus(Response::HTTP_OK)
         ->assertJsonStructure([
            'data' => [
               'continent_code',
                'currency_code',
                'iso2_code',
                'iso3_code',
                'iso_numeric_code',
                'fips_code',
                'calling_code',
                'common_name',
                'official_name',
                'endonym',
                'demonym',
            ]
        ]);
    }

    public function test_country_listed_successfully()
    {

        $this->json('GET', 'api/countries', ['Accept' => 'application/json'])
        ->assertStatus(200);

    }

    public function test_count_total_number_of_countries()
    {
        // $total_countries_number = $this->get('/api/countries')->count();
        $total_countries_number = Country::all()->count();
        return $this->assertEquals(250, $total_countries_number);
    }

    public function test_countries_can_filter_one_country()
    {
        $ghana = Country::where('common_name', 'Ghana')->first();

        $this->assertEquals('Ghana', $ghana);
    }

    public function test_where_currency()
    {
        $shortName = Country::where('currency_code', 'EUR')->get();

        $this->assertTrue($shortName);
    }

    public function test_find_country_by_continent()
    {
        $continent = Country::where('continent_code', 'AF')->get();
        $this->assertEquals('AF', $continent);
    }
}

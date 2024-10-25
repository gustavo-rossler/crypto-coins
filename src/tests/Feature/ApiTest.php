<?php

namespace Tests\Feature;

use App\Repositories\IApiCryptoCoinPricesRepository;
use App\Repositories\IDbCryptoCoinPricesRepository;
use App\Repositories\InMemoryApiCryptoCoinPricesRepository;
use App\Repositories\InMemoryDbCryptoCoinPricesRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->app->bind(
            IApiCryptoCoinPricesRepository::class,
            InMemoryApiCryptoCoinPricesRepository::class
        );
        $this->app->bind(
            IDbCryptoCoinPricesRepository::class,
            InMemoryDbCryptoCoinPricesRepository::class
        );
    }

    /**
     * Test /api/v1/crypto-coins/sync-prices endpoint.
     * @return void
     */
    public function testSyncPricesEndpoint()
    {
        $response = $this->get('/api/v1/crypto-coins/sync-prices');

        $response->assertStatus(200);
    }

    /**
     * Test /api/v1/crypto-coins/current-price endpoint.
     *
     * @return void
     */
    public function testCurrentPriceEndpoint()
    {
        $response = $this->json('GET', '/api/v1/crypto-coins/current-price?coin=btc');

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'cryptoCoinName' => 'Bitcoin',
                    'cryptoCoinSymbol' => 'btc',
                    'price' => 99.99,
                    'currency' => 'usd',
                    'timestamp' => 1729788058,
                    'datetime' => '2024-10-24 16:40:58',
                    'timezone' => 'UTC',
                ],
            ]);
    }

    /**
     * Test /api/v1/crypto-coins/historical-price?coin=eos&datetime=2024-10-24 10:00:00 endpoint.
     * For this test we have 2 pre-defined prices in 2024-10-24 at 14:40:58 and 18:40:58. So the
     * method should correctly calculate the most approximated date between these 2.
     * @return void
     */
    public function testHistoricalPriceEndpoint()
    {
        $response = $this->json(
            'GET',
            '/api/v1/crypto-coins/historical-price?coin=btc&datetime=2024-10-24 15:00:00'
        );
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'cryptoCoinName' => 'Bitcoin',
                    'cryptoCoinSymbol' => 'btc',
                    'price' => 99.99,
                    'currency' => 'usd',
                    'timestamp' => 1729780858,
                    'datetime' => '2024-10-24 14:40:58',
                    'timezone' => 'UTC',
                ],
            ]);

        # Test the most approximate calc
        $response = $this->json(
            'GET',
            '/api/v1/crypto-coins/historical-price?coin=btc&datetime=2024-10-24 17:00:00'
        );
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'cryptoCoinName' => 'Bitcoin',
                    'cryptoCoinSymbol' => 'btc',
                    'price' => 0.435,
                    'currency' => 'usd',
                    'timestamp' => 1729795258,
                    'datetime' => '2024-10-24 18:40:58',
                    'timezone' => 'UTC',
                ],
            ]);
    }
}

<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FirebaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllFirebase()
    {
        $response = $this->get('/api/firebase/')->response->getContent();
        $response = json_decode($response);
        $result = isset($response->code) && $response->code == 200 ? true : false;

        $this->assertTrue($result);
    }

    public function testInsertFirebase()
    {
        $faker = \Faker\Factory::create();
        $response = $this->post('/api/firebase/save', [
            'name' => $faker->name(),
            'phone' => $faker->phoneNumber()
        ])->response->getContent();
        $response = json_decode($response);
        $result = isset($response->code) && $response->code == 200 ? true : false;

        $this->assertTrue($result);
    }

    public function testDeleteFirebase()
    {
        $contacs = $this->get('/api/firebase/')->response->getContent();
        $contacs = json_decode($contacs);

        $key = isset($contacs->data) ? key((array)$contacs->data) : null;
        $response = $this->post('/api/firebase/delete/' . $key)->response->getContent();
        $response = json_decode($response);
        $result = isset($response->code) && $response->code == 200 ? true : false;

        $this->assertTrue($result);
    }
}

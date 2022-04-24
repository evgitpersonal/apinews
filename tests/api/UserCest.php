<?php

use Codeception\Util\HttpCode;
use Faker\Factory;

class UserCest
{
    private $accessToken = '';

    public function _before(ApiTester $I)
    {
    }



    public function createUser(\ApiTester $I)
    {
        $faker = Factory::create();
        $username = $faker->name;
        $password = $faker->password;
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPostAsJson('user', [
            'username' => $username,
            'password' => $password
        ]);

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['username' => $username]);
        $response =  json_decode($I->grabResponse(), true);
        $this->accessToken = $response['accessToken'];

    }


    public function forbidToUpdateUser(\ApiTester $I)
    {
        $faker = Factory::create();
        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPutAsJson('user/1', [
            'username' => $faker->name,
            'password' => $faker->password
        ]);

        $I->seeResponseCodeIs(403);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['name' => 'Forbidden']);

    }
}

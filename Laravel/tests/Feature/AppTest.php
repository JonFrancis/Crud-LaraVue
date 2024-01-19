<?php

namespace Tests\Feature;

use App\Models\AllUsers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AllUsersApiTest extends TestCase
{
  public function testStore()
  {
    $data =[
      "Username"=> "Joao",
      "Password"=> "123123",
      "First_Name"=> "Lusca",
      "Last_Name"=> "Math",
      "Age"=> "1",
      "Cellphone"=> "11111111111"
    ];
    $response = $this->post('/api/allusers',$data);
    $response->assertStatus(200);
  }
  public function testList()
  {
    $response = $this->get('/api/allusers');
    $response->assertStatus(200);
  }

  public function testShow()
  {
    $data =[
      "Username"=> "teste",
      "Password"=> "123123",
      "First_Name"=> "Lusca",
      "Last_Name"=> "Math",
      "Age"=> "1",
      "Cellphone"=> "11111111111"
    ];
    //Add asn user
    $postUser = $this->post('/api/allusers',$data);
    $responseData = $postUser->decodeResponseJson();
    $userId = $responseData['userId'];

    $response = $this->get("/api/allusers/{$userId}");
    $response->assertStatus(200);
  }

  public function testEdit()
  {
    $data =[
      "Username"=> "teste",
      "Password"=> "123123",
      "First_Name"=> "Lusca",
      "Last_Name"=> "Math",
      "Age"=> "1",
      "Cellphone"=> "11111111111"
    ];
    //Add an user
    $postUser = $this->post('/api/allusers',$data);
    $responseData = $postUser->decodeResponseJson();
    $userId = $responseData['userId'];

    $updatedData =[
      "Username"=> "Jota",
      "Password"=> "123123",
      "First_Name"=> "Lusca",
      "Last_Name"=> "Math",
      "Age"=> "1",
      "Cellphone"=> "11111111111"
    ];
    $response = $this->put("/api/allusers/{$userId}/edit",$updatedData);
    $response->assertStatus(200);
  }

  public function testDelete()
  {
    $data =[
      "Username"=> "teste",
      "Password"=> "123123",
      "First_Name"=> "Lusca",
      "Last_Name"=> "Math",
      "Age"=> "1",
      "Cellphone"=> "11111111111"
    ];
    //Add an user
    $postUser = $this->post('/api/allusers',$data);
    $responseData = $postUser->decodeResponseJson();
    $userId = $responseData['userId'];

    $response = $this->delete("/api/allusers/{$userId}/delete");
    $response->assertStatus(200);
  }
}
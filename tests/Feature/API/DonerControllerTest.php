<?php

namespace Tests\Feature\API;

use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class DonerControllerTest extends TestCase
{
    private $user;
    /**
     * @test
     * Testing for index function
     */
    public function can_show_a_list_of_paginated_doner_list()
    {
        // $state1 = factory(State::class)->create();
        // $state2 = factory(State::class)->create();
        // $state3 = factory(State::class)->create();
        $this->user = User::find(1);

        $response = $this->actingAs($this->user,'api')
        ->json('GET',"/api/doners");
        $response->assertStatus(200)
            ->assertJsonStructure([
            'data' => [
                '*' => ['id'],
                ],
            'links' => ['first','last','prev','next'],
            'meta' => ['current_page','from','last_page','path','per_page','to','total']
        ]);
    }

    /**
     * @test
     * Testing for store function
     */
    public function can_store_a_doner()
    {
        $doner = factory(User::class)->make();
        $this->user = User::find(1);

        $response = $this->actingAs($this->user,'api')
        ->json('POST', '/api/doners', [
            'name' => $doner->name,
            'nic' => $doner->nic,
            'gender' => $doner->gender,
            'mobile' => $doner->mobile,
            'birth_day' => $doner->birth_day,
        ]);
        // Looking for response has correct structure
        $response->assertExactJson([
            'message' => "Add New Doner Successfully",
        ])
        // Check the created state
        ->assertStatus(201);

        // Check the database for record
        $this->assertDatabaseHas('users', [
            'name' => $doner->name
        ]);
    }

        /**
     * @testt
     * This will return 404 while giving an invalied id for showing state
     * By passing this: 
     *  1. we can prove that the route is exist 
     *  2. show method is exist 
     *  3. it returns findOrFail() not find().
     */
    public function will_return_404_when_state_is_not_found_while_showing()
    {
        $response = $this->json('GET',"/api/states/-1");

        $response->assertStatus(404);
    }
    /**
     * @testt
     * Testing show method
     */
    public function can_view_a_single_state()
    {
        $state = factory(State::class)->create();

        $response = $this->json('GET',"/api/states/$state->id");
        // Checking for showing exact json return
        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'id' => $state->id,
                    'state_name' => $state->state_name,
                    'remarks' => $state->remarks
                ]
            ]);
    }

    /**
     * @testt
     * This will return 404 while giving an invalied id for updating state
     * By passing this: 
     *  1. we can prove that the route is exist 
     *  2. update method is exist  
     *  3. it is looking for $id to find the state and use findOrFail() otherthan find().
     */
    public function will_return_404_when_state_is_not_found_while_updating()
    {
        $response = $this->json('PUT',"/api/states/-1");

        $response->assertStatus(404);
    }

    /**
     * @testt
     * Test for update method
     */
    public function can_update_a_state()
    {
        $state = factory(State::class)->create();

        $response = $this->json('PUT',"/api/states/$state->id", [
            'state_name' => $state->state_name."_updated",
            'remark' => $remark = $state->id."_test_update"
        ]);
        // Checking for showing exact json return
        $response->assertStatus(202)
            ->assertExactJson([
                'message' => "State Updated successfuly",
                'responce' => [
                    'id' => $state->id,
                    'state_name' => $state->state_name."_updated",
                    'remarks' => [
                        [ 
                            'id' => $state->remarks[0]->id,
                            'body' => $remark,
                            'created_at' => (string)$state->created_at
                        ]
                    ]
                ]
            ]);

            // Checking for database record
           $this->assertDatabaseHas('states', [
                'id' => $state->id,
                'state_name' => $state->state_name."_updated",
                'created_at' => (string)$state->created_at,
                'updated_at' => (string)$state->updated_at
            ]); 
        
            // Get newly created state record 
            $updatedState = State::find($state->id);

            // Test for database has exactly record of remarks
            $this->assertDatabaseHas('remarks', [
                'id' => $updatedState->remarks[0]->id,
                'remarkable_type' => 'states',
                'remarkable_id' => $state->id,
                'body' => $remark,
                'created_at' => (string)$updatedState->remarks[0]->created_at,
                'updated_at' => (string)$updatedState->remarks[0]->updated_at
            ]);
    }

        /**
     * @testt
     * This will return 404 while giving an invalied id for deleting state
     * By passing this: 
     *  1. we can prove that the route is exist 
     *  2. update method is exist  
     *  3. it is looking for $id to find the state and use findOrFail() otherthan find().
     */
    public function will_return_404_when_state_is_not_found_while_deleting()
    {
        $response = $this->json('DELETE',"/api/states/-1");

        $response->assertStatus(404);
    }

    /**
     * @testt
     * Test for delete method
     */
    public function can_delete_a_state()
    {
        $state = factory(State::class)->create();

        $response = $this->json('DELETE',"/api/states/$state->id");
        // Checking for showing exact json return
        $response->assertStatus(204)
            ->assertSee(null);

            // Checking for database record
           $this->assertSoftDeleted('states', [
                'id' => $state->id,
            ]); 
        
        



    }
}

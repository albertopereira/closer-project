<?php

namespace Tests\Feature;

use App\User;
use App\Entity;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntitiesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_own_entities()
    {
        $entity = factory('App\Entity')->create();

        $user = User::find($entity->user_id);
        
        $this->be($user);

        $response = $this->get('/home/1');

        $response->assertSee($entity->organization_name);
    }

    public function test_user_cannot_see_others_entities()
    {
        $entity1 = factory('App\Entity')->create();
        
        $entity2 = factory('App\Entity')->create();


        $user = User::find($entity1->user_id);
        
        $this->be($user);

        $response = $this->get('/home/2' . $entity2->id);

        $response->assertDontSee($entity2->organization_name);
    }


    public function test_an_entity_is_created()
    {
        $entity = factory('App\Entity')
                    ->create(['organization_name' => 'ACME Inc.']);

        $this->assertEquals('ACME Inc.', $entity->organization_name);
    }

    public function test_an_entity_is_changed()
    {
        $entity = factory('App\Entity')
                    ->create(['organization_name' => 'ACME Inc.']);

        $entity->organization_name = 'ACME';

        $this->assertEquals('ACME', $entity->organization_name);
    }

    public function test_create_new_entity()
    {
        $user = factory('App\User')->create();

        $this->be($user);

        $response = $this->call('POST', 'home/entity/create', ['organization_name' => 'ACME Inc.']);

        $response->assertSessionHas('status', 'Entity added with success.');

        $this->assertDatabaseHas('entities', [
            'organization_name' => 'ACME Inc.'
        ]);

    }


    public function test_edit_an_entity()
    {
        $entity = factory('App\Entity')
                ->create(['organization_name' => 'ACME Inc.']);

        $user = User::find($entity->user_id);
        
        $this->be($user);

        $response = $this->call('PATCH', 'home/entity/' . $entity->id , ['organization_name' => 'ACME']);

        $response->assertSessionHas('status', 'Entity edited with success.');

        $this->assertDatabaseHas('entities', [
            'organization_name' => 'ACME'
        ]);

    }


    public function test_remove_an_entity()
    {
        $entity = factory('App\Entity')
                ->create(['organization_name' => 'ACME Inc.']);

        $user = User::find($entity->user_id);
        
        $this->be($user);

        $response = $this->call('DELETE', 'home/entity/' . $entity->id);

        $response->assertSessionHas('status', 'Entity removed with success.');

        $this->assertDatabaseMissing('entities', [
            'organization_name' => 'ACME Inc.'
        ]);

    }    
}

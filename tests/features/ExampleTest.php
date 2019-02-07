<?php

class ExampleTest extends FeatureTestCase
{

    function test_basic_example()
    {
        $user = factory(\App\User::class)->create([
          'name'=>'Luis Silva',
          'email'=>'admin@styde.net'
        ]);

        $this->actingAs($user, 'api')
             ->visit('api/user')
             ->see('Luis Silva')
             ->see('admin@styde.net');
    }
}

<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request; 

class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
}

class UserServiceTest extends TestCase
{
    /** @var UserService */
    private $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    public function testCanReturnPaginatedListOfUsers(): void
    {
        /* Creating some test users */
        Factory::factoryForModel(User::class)->count(25)->create();
        /* Get paginated users */
        $paginatedUsers = $this->userService->getAllData([], [], true);
        $this->assertIsObject($paginatedUsers);/* check if object */
        $this->assertTrue(property_exists($paginatedUsers, 'total'));
        $this->assertTrue(property_exists($paginatedUsers, 'perPage'));
        $this->assertTrue(property_exists($paginatedUsers, 'currentPage'));
        $this->assertTrue(property_exists($paginatedUsers, 'lastPage'));

        /* Optionally, check if 'data' property is present */
        if (property_exists($paginatedUsers, 'data')) {
            /* Assert that 'data' is an array or an object */
            $this->assertIsArray($paginatedUsers->data) || $this->assertIsObject($paginatedUsers->data);
            /* Assert that we have the correct number of items on the current page */
            if (is_array($paginatedUsers->data)) {
                $this->assertCount($paginatedUsers->per_page, $paginatedUsers->data);
            }
        }
    }


    public function testCanStoreUserToDatabase(): void
    {
        /* Create request data */
        $requestData = [
            'firstname' => 'Rabi',
            'lastname' => 'Gorkhali',
            'username' => 'rabigorkhali', 
            'email' => 'rabig@example.com',
            'password' => 'secret',
            'bio' => 'bio test',
        ];

        /* Create a mock request object */
        $request = new Request($requestData);

        /* Call the store method */
        $storedUser = $this->userService->store($request);

        /* Assert that the user was stored successfully */
        $this->assertDatabaseHas('users', [
            'id' => $storedUser->id,
            'firstname' => 'Rabi',
            'lastname' => 'Gorkhali',
            'username' => 'rabigorkhali',
            'email' => 'rabig@example.com',
        ]);

        /* Assert that the password is hashed */
        $this->assertTrue(Hash::check('secret', $storedUser->password));
    }

    /**
     * Test if the UserService can find and return an existing user by ID.
     */
    public function testCanFindExistingUserById(): void
    {
        /* Create a test user */
        $user = Factory::factoryForModel(User::class)->create();
        // $user = factory(User::class)->create();
        /* Call the find method with the user's ID */
        $foundUser = $this->userService->find($user->id);
        /* Assert that the user was found and returned */
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
    }

    /**
     * Test if the UserService returns null when attempting to find a non-existing user.
     */
    public function testReturnsNullForNonExistingUser(): void
    {
        /* Call the find method with a non-existing user ID */
        $nonExistingUser = $this->userService->find(999);
        /* Assert that null is returned for a non-existing user */
        $this->assertNull($nonExistingUser);
    }


    /**
     * Test if the UserService can update an existing user.
     */
    public function testCanUpdateExistingUser(): void
    {
        /* Create a test user */
        $user = Factory::factoryForModel(User::class)->create();
        /* Create request data for the update */
        $updateData = [
            'firstname' => 'UpdatedFirstName',
            'lastname' => 'UpdatedLastName',
            'status' => '1', // Updated status
            'bio' => 'bio data test',
        ];
        /* Create a mock request object */
        $request = new Request($updateData);
        /* Call the update method */
        $updatedUser = $this->userService->update($request, $user->id);
        /* Assert that the update was successful */
        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertEquals($user->id, $updatedUser->id);
        $this->assertEquals($updateData['firstname'], $updatedUser->firstname);
        $this->assertEquals($updateData['lastname'], $updatedUser->lastname);
    }

}

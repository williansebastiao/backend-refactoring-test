<?php

namespace Tests\Unit;

use App\Models\User;
use App\repositories\UserRepository;
use App\UseCases\UserService;
use Illuminate\Support\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    protected $userService;
    protected $userRepositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepositoryMock = Mockery::mock(UserRepository::class);
        $this->userService = new UserService($this->userRepositoryMock);
    }

    /**
     * A basic unit test example.
     */
    public function test_find_all_should_return_success(): void
    {
        $users = new Collection([
            new User(['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com']),
        ]);

        $this->userRepositoryMock->shouldReceive('findAll')->once()->andReturn($users);

        $result = $this->userService->findAll();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);
        $this->assertEquals('John Doe', $result[0]->name);
    }

    public function it_stores_user_successfully()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => '123456',
        ];

        $user = new User([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->userRepositoryMock->shouldReceive('store')->once()->with($data)->andReturn($user);

        $result = $this->userService->store($data);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('John Doe', $result->name);
        $this->assertEquals('john.doe@example.com', $result->email);
    }

    public function it_finds_user_by_id_successfully()
    {
        $user = new User([
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        $this->userRepositoryMock->shouldReceive('findById')->once()->with(1)->andReturn($user);

        $result = $this->userService->findById(1);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('John Doe', $result->name);
        $this->assertEquals('john.doe@example.com', $result->email);
    }

    public function it_updates_user_successfully()
    {
        $id = 1;
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $user = new User([
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'email_verified_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        $this->userRepositoryMock->shouldReceive('update')->once()->with($id, $data)->andReturn($user);

        $result = $this->userService->update($id, $data);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals('John Doe', $result->name);
        $this->assertEquals('john.doe@example.com', $result->email);
    }

    public function it_destroys_user_successfully()
    {
        $id = 1;

        $this->userRepositoryMock->shouldReceive('destroy')->once()->with($id)->andReturn(true);
        $result = $this->userService->destroy($id);
        $this->assertTrue($result);
    }
}

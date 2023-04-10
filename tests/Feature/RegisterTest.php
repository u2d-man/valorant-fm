<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Application\Actions\ActionPayload;
use App\Domain\User\UserDto;
use App\Domain\User\UserRepositoryInterface;
use Tests\TestCase;
use Mockery;

class RegisterTest extends TestCase
{
    public function testSuccessRegister()
    {
        $app = $this->getAppInstance();

        $userDto = new UserDto(
            id: 1,
            loginId: 'user_id',
            password: 'password',
            name: 'test_user'
        );

        $userRepository = Mockery::mock(UserRepositoryInterface::class);
        $userRepository
            ->shouldReceive('getUser')
            ->andReturn($userDto);

        // $container->set(UserRepositoryInterface::class, $userRepository->reveal());
        $request = $this->createRequest('POST', '/api/register');
        $response = $app->handle($request);

        $actual = (string) $response->getBody();
        $expected = json_encode(['message' => 'success user created']);

        $this->assertSame($expected, $actual);
    }
}

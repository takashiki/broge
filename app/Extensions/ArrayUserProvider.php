<?php

namespace App\Extensions;

use Illuminate\Auth\GenericUser;
use Illuminate\Cache\CacheManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ArrayUserProvider implements UserProvider
{
    protected $users;

    protected $hasher;

    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(array $users, Hasher $hasher, CacheManager $cache)
    {
        $this->users = $users;
        $this->hasher = $hasher;
        $this->cache = $cache;
    }

    protected function getCacheKey($identifier)
    {
        return "auth:user:{$identifier}";
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param mixed $identifier
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        if (array_key_exists($identifier, $this->users)) {
            $user = $this->getUser($this->users[$identifier]);
            $user->id = $identifier;

            return $user;
        }

        return null;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param mixed  $identifier
     * @param string $token
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        /** @var Authenticatable $user */
        $user = $this->cache->get($this->getCacheKey($identifier));

        return $user && $user->getRememberToken() === $token ? $user : null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string                                     $token
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $user->setRememberToken($token);
        $this->cache->forever($this->getCacheKey($user->getAuthIdentifier()), $user);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                unset($credentials[$key]);
            }
        }

        $user = Arr::first($this->users, function ($user, $identifier) use ($credentials) {
            foreach ($credentials as $key => $value) {
                if (!isset($user[$key]) || $user[$key] != $value) {
                    return false;
                }
            }

            return true;
        });

        return $this->getUser($user);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param array                                      $credentials
     *
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $this->hasher->check(
            $credentials['password'], $user->getAuthPassword()
        );
    }

    /**
     * Get the generic user.
     *
     * @param mixed $user
     *
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getUser($user)
    {
        if (!is_null($user)) {
            return new ArrayUser((array) $user);
        }

        return null;
    }
}

<?php

namespace App\Extensions;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ArrayUserProvider implements UserProvider
{
    protected $users;

    /**
     * @var Cache
     */
    protected $cache;

    public function __construct(array $users, Cache $cache)
    {
        $this->users = $users;

        $this->cache = $cache;
    }

    protected function getCacheKey($identifier, $token)
    {
        return "auth:user:{$identifier}:token:{$token}";
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
            $user = $this->getGenericUser($this->users[$identifier]);
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
        return $this->cache->get($this->getCacheKey($identifier, $token));
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string                                     $token
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        $this->cache->put($this->getCacheKey($user->getAuthIdentifier(), $token), $user);
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
            if (!Str::contains($key, 'password')) {
                foreach ($this->users as $identifier => $data) {
                    if (array_search($value, $data) === $key) {
                        return $this->retrieveById($identifier);
                    }
                }
            }
        }

        return null;
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
        // TODO: Implement validateCredentials() method.
    }

    /**
     * Get the generic user.
     *
     * @param mixed $user
     *
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        if (!is_null($user)) {
            return new GenericUser((array) $user);
        }

        return null;
    }
}

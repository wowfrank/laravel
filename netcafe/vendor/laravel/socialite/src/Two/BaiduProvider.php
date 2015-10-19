<?php

namespace Laravel\Socialite\Two;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class BaiduProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * @var string
     */
    private $openId;

    /**
     * The scopes being requested.
     *
     * @var array
     */
    // protected $scopes = ['getInfo'];

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getAuthUrl()
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://openapi.baidu.com/oauth/2.0/authorize', $state);
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getTokenUrl()
     */
    protected function getTokenUrl()
    {
        return 'https://openapi.baidu.com/oauth/2.0/token';
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getUserByToken()
     */
    protected function getUserByToken($token)
    {
	$tokenArray = json_decode($token, true);
        $response = $this->getHttpClient()->get('https://openapi.baidu.com/rest/2.0/passport/users/getInfo?access_token='.$tokenArray['access_token']);
	
	return json_decode($this->removeCallback($response->getBody()->getContents()), true);
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::mapUserToObject()
     */
    protected function mapUserToObject(array $user)
    {
	return (new User())->setRaw($user)->map([
		    'id' => $this->openId, 'nickname' => $user['username'],
		    'name' => $user['username'], 'email' => 'from.baidu.' . $user['userid'] . '@example.com', 
		    'avatar' => 'http://tb.himg.baidu.com/sys/portrait/item/' . $user['portrait'],
		    ]);
    }


    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getTokenFields()
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }

    /**
     * {@inheritdoc}.
     *
     * @see \Laravel\Socialite\Two\AbstractProvider::getAccessToken()
     */
    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->get($this->getTokenUrl(), [
            'query' => $this->getTokenFields($code),
        ]);

        return $response->getBody()->getContents();
    }

    /**
     * @param mixed $response
     *
     * @return string
     */
    protected function removeCallback($response)
    {
        if (strpos($response, 'callback') !== false) {
            $lpos = strpos($response, '(');
            $rpos = strrpos($response, ')');
            $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
        }

        return $response;
    }
}

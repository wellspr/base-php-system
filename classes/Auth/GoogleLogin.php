<?php

class GoogleLogin
{

    // Start a new google client
    public function __construct()
    {

        $this->client = new Google_Client();

    }

    // Set client configurations
    public function setClientConfig(array $config)
    {

        $this->config = $config;

    }

    // Get client configurations
    public function getClientConfig()
    {

        return $this->config;

    }

    // Define the client with specified configurations
    public function clientDefine()
    {

        $config = $this->getClientConfig();

        $this->client->setAuthConfig($config['credentials']);
        $this->client->addScope($config['scope']);

        /* Your redirect URI can be any registered URI...

        /* Redirect to this page */
        $redirect_uri = $config['redirect_uri'];

        $this->client->setRedirectUri($redirect_uri);

        /**
         * Set the prompt hint. Valid values are none, consent and select_account.
         * If no value is specified and the user has not previously authorized
         * access, then the user is shown a consent screen.
         * @param $prompt string
         *  {@code "none"} Do not display any authentication or consent screens. Must not be specified with other values.
         *  {@code "consent"} Prompt the user for consent.
         *  {@code "select_account"} Prompt the user to select an account.
        */
        // $client->setConfig('prompt', 'select_account');
        /* or */
        $this->client->setPrompt($config['prompt']);

    }

    // Create the auth url to google signin
    public function authUrl()
    {

        $this->clientDefine();

        return $this->client->createAuthUrl();

    }

    /* Input type: @Array
    * Expects $code = $_GET['code']
    */
    public function getProfile($code):object
    {

        $client = $this->client;

        $token = $client->fetchAccessTokenWithAuthCode($code);
        // var_dump($token);

        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email =  $google_account_info->email;
        $name =  $google_account_info->name;
        $locale = $google_account_info->locale;
        $picture = $google_account_info->picture;
        $verified_email = $google_account_info->verified_email;
        $googleID = $google_account_info->id;

        $profile = [
            'email' => $email,
            'name' => $name,
            'locale' => $locale,
            'picture' => $picture,
            'verified_email' => $verified_email,
            'googleID' => $googleID
        ];

        $profile = json_encode($profile);
        $profile = json_decode($profile);

        return $profile;
    }


    public function startSession($profile)
    {

        $_SESSION['name'] = $profile->name;
        $_SESSION['email'] = $profile->email;
        $_SESSION['id'] = $profile->googleID;
        $_SESSION['picture'] = $profile->picture;
        $_SESSION['locale'] = $profile->locale;
        $_SESSION['verified_email'] = $profile->verified_email;
        $_SESSION['newlogin'] = true;
        $_SESSION['username'] = $profile->email;

    }

    // Generate a Google button login
    public function buttonGenerate()
    {

    $imagePath = '/resources/google/images/google-signin-buttons';
    $dir = '/1x';
    $img = '/btn_google_signin_dark_normal_web.png';

    echo <<<EXCERPT
        <style>
            .center{
                text-align: center;
            }
        </style>
EXCERPT;

    echo '<div class="center">';

    echo '<a href="' . $this->authUrl() . '">';

    echo '<img src="' . $imagePath . $dir . $img . '" alt="Google Signin Button">';

    echo '</a>';

    echo '</div>';

    }

    public function getClient()
    {

        return $this->client;

    }

}

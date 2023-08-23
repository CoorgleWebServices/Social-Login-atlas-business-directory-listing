<?php

// Developed by Coorgle web Services
// https://cws.coorgle.com

require_once APPPATH . 'libraries/Facebook/autoload.php'; // Đường dẫn đến thư viện Facebook SDK
require_once APPPATH . 'libraries/vendor/autoload.php';

class SocialLogin extends CI_Controller
{
    private $fb;

    private $google_client;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        $this->fb = new Facebook\Facebook([
            'app_id' => 'APP-ID-HERE',
            'app_secret' => 'APP-SECRET-HERE',
            'default_graph_version' => 'v17.0',
        ]);

        $this->google_client = new Google_Client();
        $this->google_client->setClientId('GOOGLE-CLIENT-ID-HERE');
        $this->google_client->setClientSecret('GOOGLE-CLIENT-SECRET-HERE');
        $this->google_client->setRedirectUri(site_url('socialLogin/loginGoogleCallback'));
        $this->google_client->setScopes(['email', 'profile']);
    }

    public function loginFacebook()
    {
        $helper = $this->fb->getRedirectLoginHelper();

        $permissions = ['public_profile']; // 

        $loginUrl = $helper->getLoginUrl(site_url('socialLogin/loginFacebookCallback'), $permissions);

        redirect($loginUrl);
    }

    public function loginFacebookCallback()
    {
        $helper = $this->fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // Xử lý lỗi từ Facebook API
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // Xử lý lỗi SDK
        }

        if (isset($accessToken)) {
            $response = $this->fb->get('/me?fields=id,name,email', $accessToken);
            $user = $response->getGraphUser();

            $credential = array('provider' => 'facebook', 'provider_id' => $user->getId(), 'is_verified' => 1);

            $query = $this->db->get_where('user', $credential);
            if ($query->num_rows() <= 0) {
                $data_user = [
                    'provider' => 'facebook',
                    'provider_id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'is_verified' => 1,
                    'role_id' => 2,
                    'wishlists' => '[]',
                ];
                $this->db->insert('user', $data_user);
            }

            $user = $this->db->get_where('user', $credential)->row();
            $this->session->set_userdata('is_logged_in', 1);
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('role_id', $user->role_id);
            $this->session->set_userdata('role', get_user_role('user_role', $user->id));
            $this->session->set_userdata('name', $user->name);

            $this->session->set_userdata('user_login', '1');
            $this->session->set_userdata('user', $user);

            redirect(site_url('user/dashboard'), 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('provided_credentials_are_invalid'));
            redirect(site_url('home/login'), 'refresh');

        }
    }

    public function loginGoogle()
    {
        $auth_url = $this->google_client->createAuthUrl();
        redirect($auth_url);
    }

    public function loginGoogleCallback()
    {
        $code = $this->input->get('code');
        if ($code) {
            $access_token = $this->google_client->fetchAccessTokenWithAuthCode($code);

            if ($access_token) {
                $google_service = new Google_Service_Oauth2($this->google_client);
                $google_user = $google_service->userinfo->get();
                $credential = array('provider' => 'google', 'provider_id' => $google_user->getId(), 'is_verified' => 1);

                $query = $this->db->get_where('user', $credential);
                if ($query->num_rows() <= 0) {
                    $data_user = [
                        'provider' => 'google',
                        'provider_id' => $google_user->getId(),
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'is_verified' => 1,
                        'role_id' => 2,
                    'wishlists' => '[]',
                    ];
                    $this->db->insert('user', $data_user);
                }

                $user = $this->db->get_where('user', $credential)->row();
                $this->session->set_userdata('is_logged_in', 1);
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('role_id', $user->role_id);
                $this->session->set_userdata('role', get_user_role('user_role', $user->id));
                $this->session->set_userdata('name', $user->name);

                $this->session->set_userdata('user_login', '1');
                $this->session->set_userdata('user', $user);

                redirect(site_url('user/dashboard'), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('provided_credentials_are_invalid'));
                redirect(site_url('home/login'), 'refresh');

            }
        }
    }
}
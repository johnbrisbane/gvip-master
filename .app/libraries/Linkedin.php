<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Linkedin
{
    private $CI;

    private $linkedin;

    private $redirect_uri = 'signup/linkedin/authorized';

    private $token;

    private $scope = array(
        'r_emailaddress',
        'r_liteprofile'
    );

    private $profile_fields = array(
        'firstName',
        'lastName',
        'emailAddress',
        'profilePicture'
    );

    private $company_fields = array(
        'id',
        'name',
        'website-url',
        'industries',
        'logo-url',
        'employee-count-range',
        'specialties',
        'locations',
        'company-type',
    );

    function __construct()
    {
        $this->CI =& get_instance();

        $config = $this->CI->config->item('linkedin');
        $inATestingEnvironment = in_array(ENVIRONMENT, ['development', 'staging'], true);

        $this->CI->load->library('OAuth2/OAuth2');

        $secure_base_url = str_replace('http://', 'https://', base_url());
        $redirect_url = ($inATestingEnvironment ? base_url() : $secure_base_url) . $this->redirect_uri;
        $this->linkedin = $this->CI->oauth2->provider('Linkedin', array(
            'id'            => $config['api_key'],
            'secret'        => $config['secret_key'],
            'redirect_uri'  => $redirect_url,
            'scope'         => $this->scope,
        ));
    }

    public function get_state()
    {
        return $this->CI->session->userdata('oauth2.state');
    }

    public function authorize()
    {
        $this->linkedin->authorize();
    }

    public function profile()
    {
        $code = $this->CI->input->get_post('code');

        if (! $code) {
            $error = $this->CI->input->get_post('error');
            $error_descritpion = $this->CI->input->get_post('error_description');
            // If the user clicks Cancel we'll get
            // error = 'access_denied' && strtolower($error_description) = 'the user denied your request'
            // For now just throw a generic exception
            if ($error) throw New Exception($error_descritpion ?: '');
        }

        $state = $this->CI->input->get_post('state');
        if (! $state || $state !== $this->get_state()) throw new Exception('Invalid state');

        $token = $this->linkedin->access($code);
        $profile = $this->linkedin->get_user_info2($token, $this->profile_fields);

        return $profile;
    }
}


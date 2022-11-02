<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

    protected  $headerdata = array();

    function __construct() {
        parent::__construct();

        // Load Stripe library
        $this->load->library('stripe');

        // Load product model
        $this->load->model('product');

        $languageSession = sess_var('lang');
        get_language_file($languageSession);

        // If the user is not logged in then redirect to the login page
        auth_check();

        //Set Header Data for this page like title,bodyid etc
        $this->headerdata['bodyid'] = 'products';
        $this->headerdata['bodyclass'] = '';
        $this->headerdata['title'] = build_title('Products');

        // Set Footer Data
        $this->footer_data['lang'] = langGet();
    }

    public function index(){
        $data = array();

        // Get products from the database
        $data['products'] = $this->product->getRows();

        // Pass products data to the list view
        // Render the page
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    function purchase($id){
        $data = array();

        // Get product data from the database
        $product = $this->product->getRows($id);

        // If payment form is submitted with token
        if($this->input->post('stripeToken')){
            // Retrieve stripe token and user info from the posted form data
            $postData = $this->input->post();
            $postData['product'] = $product;

            // Make payment
            $paymentID = $this->payment($postData);

            // If payment successful
            if($paymentID){
                redirect('products/payment_status/'.$paymentID);
            }else{
                $apiError = !empty($this->stripe->api_error)?' ('.$this->stripe->api_error.')':'';
                $data['error_msg'] = 'Transaction has been failed!'.$apiError;
            }
        }


        $this->load->model('expertise_model');
        $uid = (int) sess_var('uid');
        $users = $this->expertise_model->get_user($uid);
        if (empty($users)) show_404();
        unset($users['password']);

        // Pass product data to the details view
        $data['product'] = $product;
        $data['user'] = $users;

        if ($id == 1){
            $view = 'private';
        }
        elseif ($id == 2){
            $view = 'public';
        }
        else{
            $view = 'details';
        }
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('products/'.$view, $data);
        $this->load->view('templates/footer', $this->footer_data);
    }

    function payment($postData){

        // If post data is not empty
        if(!empty($postData)){
            // Retrieve stripe token and user info from the submitted form data
            $token  = $postData['stripeToken'];
            $name = $postData['name'];
            $email = $postData['email'];

            // Add customer to stripe
            $customer = $this->stripe->addCustomer($email, $token);

            if($customer){
                // Charge a credit or a debit card
                $charge = $this->stripe->createCharge($customer->id, $postData['product']['name'], $postData['product']['price']);

                if($charge){
                    // Check whether the charge is successful
                    if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
                        // Transaction details
                        $transactionID = $charge['balance_transaction'];
                        $paidAmount = $charge['amount'];
                        $paidAmount = ($paidAmount/100);
                        $paidCurrency = $charge['currency'];
                        $payment_status = $charge['status'];

                        // Insert tansaction data into the database
                        $orderData = array(
                            'product_id' => $postData['product']['id'],
                            'buyer_name' => $name,
                            'buyer_email' => $email,
                            'paid_amount' => $paidAmount,
                            'paid_amount_currency' => $paidCurrency,
                            'txn_id' => $transactionID,
                            'payment_status' => $payment_status
                        );
                        $orderID = $this->product->insertOrder($orderData);

                        // If the order is successful
                        if($payment_status == 'succeeded'){
                            return $orderID;
                        }
                    }
                }
            }
        }
        return false;
    }

    function payment_status($id){
        $data = array();

        // Get order data from the database
        $order = $this->product->getOrder($id);

        // Pass order data to the view
        $data['order'] = $order;
        $this->load->view('templates/header', $this->headerdata);
        $this->load->view('products/payment-status', $data);
        $this->load->view('templates/footer', $this->footer_data);
    }
}
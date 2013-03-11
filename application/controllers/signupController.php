<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the SignUp Controller for the application to manage the signup functionality.
 *
 * @author: Rishabh Dev Bansal
 * @created on: 9/1/13 3:14 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class signupController extends SaanController
{

    /**
     * @purpose: This is the action for the Signup Page
     * @return mixed|void
     */
    public function index()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Sign Up";
        $this->registry->template->CategoryArray = $this->getCategoryList();
        $this->registry->template->show("signup");
    }


    /**
     * @purpose: This function registers the new expert in to the system by inserting a new row and sending an email for
     * verification
     * @author: Rishabh Dev Bansal
     */
    public function register()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Sign Up";
        if ($this->isPostBack()) {

            $postArray = $this->requestPost();

            /* *********************** Start: Validation of the Data from Post *********************** */

            if ($this->registry->validation->isEmpty($postArray['expert_name'])) {
                $_SESSION['error'][] = "Please Enter Expert Name.";

            }
            if ($this->registry->validation->isEmpty($postArray['expert_phone_number'])) {
                $_SESSION['error'][] = "Please Enter Phone.";
            }
            else {
                if ($this->registry->validation->validatePhone($postArray['expert_phone_number']) === FALSE) {
                    $_SESSION['error'][] = "Please Enter Correct Phone Number.";
                }
            }

            if ($this->registry->validation->isEmpty($postArray['expert_email'])) {
                $_SESSION['error'][] = "Please Enter Email.";
            }
            else {
                if ($this->registry->validation->validateEmail($postArray['expert_email']) === FALSE) {
                    $_SESSION['error'][] = "Please Enter Correct Email Address.";
                }
            }

            if ($postArray['expert_category'] == "0") {
                $_SESSION['error'][] = "Please Select Expert Category.";
            }
            if ($this->registry->validation->isEmpty($postArray['expert_credential_description'])) {
                $_SESSION['error'][] = "Please Enter credentials.";
            }
            if ($this->registry->validation->isEmpty($postArray['password'])) {
                $_SESSION['error'][] = "Please Enter Password.";
            }
            if ($this->registry->validation->isEmpty($postArray['pass_confirm'])) {
                $_SESSION['error'][] = "Please Enter Confirm Password.";
            }

            if ($this->registry->validation->isEqualValue($postArray['password'], $postArray['pass_confirm']) === FALSE) {
                $_SESSION['error'][] = "Please Check Password and Confirm Password.";
            }

            if ($this->getExpertByEmail($postArray['expert_email']) > 0) {
                $_SESSION['error'][] = "This email address is already registered.";
            }

            /* *********************** End: Validation of the Data from Post *********************** */

            if (count($_SESSION['error']) == 0) {
                /* *********************** Start: Formation of the POST Array for Submission *********************** */

                $postArray['expert_email_active_code'] = rand(10000000, 99999999);
                $postArray['expert_phone_active_code'] = rand(10000000, 99999999);
                $expert_email_active_code = $this->registry->security->encryptData($postArray['expert_email_active_code']);
                $expert_email = $this->registry->security->encryptData($postArray['expert_email']);
                $postArray['expert_password'] = md5($postArray['password']);
                $postData = array('expert_name' => $postArray['expert_name'],
                    'expert_phone_number' => $postArray['expert_phone_number'],
                    'expert_address' => $postArray['expert_address'],
                    'expert_email' => $postArray['expert_email'],
                    'expert_paypal' => $postArray['expert_paypal'],
                    'expert_category_id' => $postArray['expert_category'],
                    'expert_credential_description' => $postArray['expert_credential_description'],
                    'expert_email_active_code' => $postArray['expert_email_active_code'],
                    'expert_phone_active_code' => $postArray['expert_phone_active_code'],
                    'expert_password' => $postArray['expert_password'],
                    'expert_status' => "inactive"
                );

                /* *********************** End: Formation of the POST Array for Submission *********************** */

                $lastInsertedId = $this->registry->model->run('registerExpert', $postData);
                /* ********** Start: This inserts the Expert to the amount_due_details table. ***************** */
                $amountDueArray = array('expert_id' => $lastInsertedId,
                                        'amount_due_value' => '0.00');
                $this->registry->model->run('insertAmountDueTable', $amountDueArray);

                /* ********** End: This inserts the Expert to the amount_due_details table. ***************** */
                $this->registry->model->run('updateExpertPic', $lastInsertedId);
                $templateArray = appController::getTemplateByName('registration');
                $msg = $templateArray[0]['email_template_content'];

                $linkValue = __SITE_URL . "signup/activateExpert/expert_email:$expert_email/active_code:$expert_email_active_code";
                $msg = str_replace("{EXPERT_NAME}", ucwords($postArray['expert_name']), $msg);
                $msg = str_replace("{VERIFY_LINK}", $linkValue, $msg);

                /* *************************** Start: Send Email to the Expert Registered ************************* */

                $message = Swift_Message::newInstance(ucwords($templateArray[0]['email_template_subject']))
                    ->setFrom(array(FROM_EMAIL => FROM_NAME))
                    ->setBody($msg, 'text/html');
                $message->setTo(array($postArray['expert_email'] => $postArray['expert_name']));
                $failedRecipients = array(FAILED_EMAIL => FAILED_NAME);
                $this->registry->mailer->send($message, $failedRecipients);

                /* *************************** End: Send Email to the Expert Registered ************************* */

                $_SESSION['success'] = "You have been registered successfully. A verification email has been sent to your address. Make sure to check your spam folder as it sometimes will appear there";
            }
            else {
                $this->registry->template->PostRetain = $postArray;
            }
        }
        $this->registry->template->CategoryArray = $this->getCategoryList();
        $this->registry->template->show("signup");
    }


    /**
     * @purpose: This function activate the Expert for Email verification.
     * @author: Saurabh Sinha
     *
     * @param $arg
     */
    public function activateExpert($arg)
    {
        $args = array();
        $args['expert_email'] = $this->registry->security->decryptData($arg['expert_email']);
        $args['active_code'] = $this->registry->security->decryptData($arg['active_code']);

        $inactiveExpertArray = $this->registry->model->run(getExpertByEmailnCode, $args);
        if (count($inactiveExpertArray) > 0) {
            if ($inactiveExpertArray[0]['expert_status'] == 'inactive') {
                $this->registry->model->run(activateExpert, $args);
                $_SESSION['success'] = "Your Email is Verified Successfully and your profile is activated. Please Login to use your account.";
            }
            elseif ($inactiveExpertArray[0]['expert_status'] == 'active') {
                $_SESSION['error'][] = "Your Email address is already verified.";
            }

        }
        else {
            $_SESSION['error'][] = "Invalid Token for Email Verification.";
        }
        $this->registry->template->show("activate_expert");
    }


    public function getCategoryList()
    {
        return $this->registry->model->run('getCategoryList');
    }

    public function getExpertByEmail($emailAddress)
    {
        return $this->registry->model->run('getExpertByEmail', $emailAddress);
    }
}


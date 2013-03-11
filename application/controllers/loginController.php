<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the Login Controller to manage the login functionality in the application
 *
 * @author: Rishabh Dev Bansal
 * @created on: 9/1/13 3:12 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class loginController extends SaanController
{


    public function index()
    {
        if(isset($_SESSION['expert_email']))
        {
            General::redirect(__SITE_URL . "expert");
        }
        $this->registry->template->Title = " Infopedia - Technical Support Center:Login Page";
        $this->registry->template->show("login");
    }

    /**
     * @purpose: This function handles te Login functionlaity in the system.
     * @author: Rishabh Dev Bansal
     */
    public function expertLogin()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Login Page";

        /* ******************* Start: Validating the values from the Form POST **************** */

        if ($this->isPostBack()) {
            $postArray = $this->requestPost();
            $this->registry->template->UsernameValue = $postArray['user_login'];
            if ($this->registry->validation->isEmpty($postArray['user_login'])) {
                $_SESSION['error'][] = "Please Enter Email Address.";
            }
            else {
                if ($this->registry->validation->validateEmail($postArray['user_login']) === FALSE) {
                    $_SESSION['error'][] = "Please Enter Correct Email Address.";
                }
            }

            if ($this->registry->validation->isEmpty($postArray['password'])) {
                $_SESSION['error'][] = "Please Enter Password.";
            }

            if (count($_SESSION['error']) == 0) {
                $login_status = $this->registry->model->run(expertLogin, $postArray);

                if (count($login_status) > 0) {
                    $_SESSION['expert_email'] = $postArray['user_login'];
                    $loginDetailArray = array('session_id' => session_id(),
                                                'expert_id' => $login_status[0]['expert_id'],
                                                'browser_name' => $_SERVER['HTTP_USER_AGENT'],
                                                'ip_address' => $_SERVER['REMOTE_ADDR'],
                                                'login_datetime' => time());
                    appController::logLoginDetails($loginDetailArray);
                    $_SESSION['expert_id'] = $login_status[0]['expert_id'];
                    General::redirect(__SITE_URL . "expert");
                    exit;
                }
                else {
                    $_SESSION['error'][] = "Invalid Login Credential. Please Try Again";
                }
            }
        }

        /* ******************* End: Validating the values from the Form POST **************** */

        $this->registry->template->show("login");
    }

    public function forgot_password()
    {
        if($this->isPostBack())
        {
            $postArray = $this->requestPost();
            if($this->registry->validation->isEmpty($postArray['forgot_email']))
            {
                $_SESSION['error'][] = "Please Enter Email Address";
            }
            else
            {
                if($this->registry->validation->validateEmail($postArray['forgot_email']) === FALSE)
                {
                    $_SESSION['error'][] = "Please Enter Correct Email Address";
                }
            }
            if(count($_SESSION['error']) == 0)
            {
                $userArray = $this->registry->model->run('getUserByEmail', $postArray['forgot_email']);
                if(is_array($userArray) && count($userArray) > 0)
                {
                    if($userArray[0]['expert_status'] == 'active')
                    {
                        $newPassword = $this->randomString();
                        $postArray['new_password'] = md5($newPassword);
                        $this->registry->model->run('updatePasswordByEmail', $postArray);
                        $templateArray = appController::getTemplateByName('reset_password');
                        $msg = $templateArray[0]['email_template_content'];

                        $msg = str_replace("{EXPERT_NAME}", ucwords($userArray[0]['expert_name']), $msg);
                        $msg = str_replace("{NEW_PASSWORD}", $newPassword, $msg);

                        /* *************************** Start: Send Email to the Expert Registered ************************* */

                        $message = Swift_Message::newInstance(ucwords($templateArray[0]['email_template_subject']))
                            ->setFrom(array(FROM_EMAIL => FROM_NAME))
                            ->setBody($msg, 'text/html');
                        $message->setTo(array($postArray['forgot_email'] => $userArray[0]['expert_name']));
                        $failedRecipients = array(FAILED_EMAIL => FAILED_NAME);
                        $this->registry->mailer->send($message, $failedRecipients);
                        $_SESSION['success'] = "New Password has been sent to your email address";
                    }
                    else{
                        $_SESSION['error'][] = "Please Verify your email address to use Reset Password";
                    }
                }
                else{
                    $_SESSION['error'][] = "Email Address is not registered yet.";
                }
            }
        }
        $this->registry->template->PostArray = $postArray;
        $this->registry->template->show('forgot_password');
    }
}

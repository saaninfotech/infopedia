<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose:
 *
 * @author: Rishabh Dev Bansal
 * @created on: 12/1/13 4:28 PM
 *
 */

/***********************************************************************/


class expertController extends SaanController
{

    /**
     * @purpose: This is the action for the Expert Home Page
     * @author: Saurabh Sinha
     * @return mixed|void
     */
    public function index()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Sign Up";
        $this->registry->template->show("experts/experthome");
    }

    /**
     * @purpose: This is the Signout action
     * @author: Saurabh Sinha
     */
    public function signout()
    {
        $expertIdArray = appController::getExpertIdByEmail($_SESSION['expert_email']);
        appController::markExpertLogout(session_id(), $expertIdArray[0]['expert_id']);
        session_destroy();
        General::redirect(__SITE_URL);
    }

    /**
     * @purpose: This is the action for the Feedback Page
     * @author: Saurabh Sinha
     */
    public function expertFeedbacks($args)
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Expert Feedback";
        $args['expert_id'] = $_SESSION['expert_id'];
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->FeedbackListArray = $this->registry->model->run('getFeedbackListByExpertId', $args);
        $this->registry->template->show('experts/my_feedbacks');
    }

    /**
     * @purpose: This is the action for the User List Page for the Expert
     * @author: Saurabh Sinha
     */
    public function expertUserList($args)
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Expert User List";
        $args['expert_id'] = $_SESSION['expert_id'];
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->CustomerListArray = $this->registry->model->run('getCustomerListByExpertId', $args);
        $this->registry->template->show('experts/my_users');
    }

    public function read_feedback($args)
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Expert User List";
        if(is_array($args))
        {
            $feedbackId = $this->registry->security->decryptData($args['feedback_id']);
            $feedbackArray = $this->registry->model->run('getFeedbackByFeedbackId', $feedbackId);
            if($feedbackArray[0]['expert_read'] == "no")
            {
                $this->registry->model->run('updateFeedbackRead', $feedbackId);
            }
            $this->registry->template->FeedbackArray = $feedbackArray;
        }
        $this->registry->template->show('experts/read_feedback');
    }

    /**
     * @purpose: This is the Action for the Earning page for the Expert
     * @author: Saurabh Sinha
     */
    public function expertEarnings()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Expert Earning";
        $args['expert_id'] = $_SESSION['expert_id'];
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->ExpertEarningArray = $this->registry->model->run('getExpertEarningsByEmailId', $args);
        $this->registry->template->show('experts/my_earnings');
    }

    /**
     * @purpose: This action manages the update profile pic functionality for the Experts.
     * @author: Saurabh Sinha
     */
    public function expertUpdatePic()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Expert Earning";
        if ($this->isPostBack()) {
            if ($_FILES['expert_pic']['name'] != '') {
                $allowedExts = array("jpg", "jpeg", "gif", "png");
                $extension = end(explode(".", $_FILES["expert_pic"]["name"]));
                if ((($_FILES["expert_pic"]["type"] == "image/gif")
                    || ($_FILES["expert_pic"]["type"] == "image/jpeg")
                    || ($_FILES["expert_pic"]["type"] == "image/png")
                    || ($_FILES["expert_pic"]["type"] == "image/pjpeg"))
                    && ($_FILES["expert_pic"]["size"] < 200000)
                    && in_array($extension, $allowedExts)
                ) {
                    $uploadPath = __VIEW_PATH . "uploads/expert_profile_image/";
                    if (move_uploaded_file($_FILES["expert_pic"]["tmp_name"], $uploadPath . $_SESSION['expert_id'] . ".jpg")) {
                        $_SESSION['success'] = "Your profile pic is updated successfully.";
                        General::redirect(__SITE_URL . "expert/expertUpdatePic");
                        exit;
                    }
                }
                else {
                    $_SESSION['error'][] = "The picture you are trying to upload does not meet the validity. Please check for Valid (.jpg, .jpeg, .png, .gif) file with size less than 2 MB";
                }
            }
            else {
                $_SESSION['error'][] = "Please Select a Picture to Upload";
            }
        }

        $this->registry->template->show('experts/update_profile_pic');
    }

    /**
     * @purpose: This is the action for the Edit Profile page for the Expert
     * @author: Saurabh Sinha
     */
    public function expertEditProfile()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Edit Profile";
        $this->registry->template->CategoryArray = $this->getCategoryList();

        /* ********************** Start: This is the POST Back Handler Section *********************** */

        if ($this->isPostBack()) {
            $postArray = $this->requestPost();

            /* ************************ Start: Validation of the POST Array and reassign on error ****************** */

            foreach ($postArray as $postKey => $postValue) {
                if ($this->registry->validation->isEmpty($postValue)) {
                    $controlName = ucwords(str_replace("_", " ", $postKey));
                    $_SESSION['error'][] = "$controlName is a required field";
                }
                else {
                    if ($postKey == "expert_paypal" && $this->registry->validation->validateEmail($postValue) === FALSE) {
                        $_SESSION['error'][] = "Please Enter a Valid Paypal Email";
                    }
                    if ($postKey == "expert_phone_number" && $this->registry->validation->validatePhone($postValue) === FALSE) {
                        $_SESSION['error'][] = "Please Enter a Valid Phone Number";
                    }

                }
            }

            /* ************************ End: Validation of the POST Array and reassign on error ****************** */

            if (count($_SESSION['error']) == 0) {
                $postArray['session_expert_email'] = $_SESSION['expert_email'];

                //This is the Model Function call for update profile
                if ($this->registry->model->run('updateExpertProfile', $postArray)) {
                    $_SESSION['success'] = "Your Profile is Updated Successfully";
                    General::redirect(__SITE_URL . "expert/expertEditProfile");
                }
            }
            else {
                /*
                * This is the re-assignment of the Post Array to the same $expertArray to retain the Post Values instead
                * of the values from the database;
                */
                $this->registry->template->ExpertArray = $postArray;
            }
        }

        /* ********************** End: This is the POST Back Handler Section *********************** */

        $this->registry->template->show('experts/edit_profile');
    }

    /**
     * @purpose: This is the action for the Contact Admin Page for the Expert
     * @author: Saurabh Sinha
     */
    public function expertContactAdmin()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:Expert Contact Admin";
        $this->registry->template->show('experts/contact_admin');
    }

    /**
     * @purpose: This function gets the Expert Array with respect to the Expert Email
     * @author: Saurabh Sinha
     *
     * @param $emailAddress
     *
     * @return mixed
     */
    public function getExpertByEmail($emailAddress)
    {
        $expertAssocArray = $this->registry->model->run('getExpertByEmail', $emailAddress);
        foreach ($expertAssocArray[0] as $key => $value) {
            $expertArray[$key] = $value;
        }

        return $expertArray;
    }

    /**
     * @purppose: This function gets the complete list of categories availbale in the active status
     * @author: Saurabh Sinha
     * @return mixed
     */
    public function getCategoryList()
    {
        return $this->registry->model->run('getCategoryList');
    }

    /**
     * @purpose: This action manages the change password funcality
     * @author: Saurabh Sinha
     */
    public function settings()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center: Change Password";
        if($this->isPostBack())
        {
            $postArray = $this->requestPost();

            foreach($postArray as $postKey=>$postValue)
            {
                if($this->registry->validation->isEmpty($postValue))
                {
                    $controlName = ucwords(str_replace("_", " ", $postKey));
                    $_SESSION['error'][] = "$controlName is a required field";
                }
                else
                {
                    if($postKey == "old_password")
                    {
                        $credArray['old_password'] = md5($postValue);
                        $credArray['expert_email'] = $_SESSION['expert_email'];
                        $validOldPass = $this->registry->model->run('validateOldPassword', $credArray);
                        if($validOldPass < 1)
                        {
                            $_SESSION['error'][] = "Old Password is incorrect. Please Try Again.";
                        }
                    }
                }
            }
            if(count($_SESSION['error']) == 0)
            {
                if(($this->registry->validation->isEqualValue($postArray['new_password'], $postArray['confirm_new_password'])) === FALSE)
                {
                    $_SESSION['error'][] = "Password and Confirm Password does not match";
                }
            }

            if(count($_SESSION['error']) == 0)
            {
                $updateArray['new_password'] = md5($postArray['confirm_new_password']);
                $updateArray['expert_email'] = $_SESSION['expert_email'];
                $this->registry->model->run('updatePassword', $updateArray);
                $_SESSION['success'] = "Password is changed successfully.";
                General::redirect(__SITE_URL . "expert/settings");
                exit;
            }
        }
        $this->registry->template->show('experts/change_password');
    }

    public function updateCallStatus($args)
    {
        if(is_array($args))
        {
            $adviceRequestId = $this->registry->security->decryptData($args['advice_id']);
            if($this->registry->model->run('updateCallStatus', $adviceRequestId))
            {
                appController::countExpertPendingCalls($_SESSION['expert_id'], TRUE);
                $templateArray = appController::getTemplateByName('feedback_mail');
                $randValue = rand(10000,99999);
                $tokenValue = $this->registry->security->encryptData($randValue);
                $expertIdValue = $this->registry->security->encryptData($_SESSION['expert_id']);
                $adviceArray = $this->registry->model->run('getAdviceByAdviceId', $adviceRequestId);

                $this->registry->model->run('updateAdviceCountByExpertId', $_SESSION['expert_id']);
                $feedbackArray = array('advice_id' => $adviceRequestId,
                                        'token_value' => $randValue
                                        );
                $this->registry->model->run('addFeedback', $feedbackArray);
                $msg = $templateArray[0]['email_template_content'];

                $linkValue = __SITE_URL . "index/feedback/advice_id:" . $args['advice_id'] . "/token_value:$tokenValue/expert_id:$expertIdValue";
                $msg = str_replace("{CUSTOMER_NAME}", ucwords($adviceArray[0]['user_fullname']), $msg);
                $msg = str_replace("{FEEDBACK_LINK}", $linkValue, $msg);

                /* *************************** Start: Send Email to the Expert Registered ************************* */

                $message = Swift_Message::newInstance(ucwords($templateArray[0]['email_template_subject']))
                    ->setFrom(array(FROM_EMAIL => FROM_NAME))
                    ->setBody($msg, 'text/html');
                $message->setTo(array($adviceArray[0]['user_email_address'] => $adviceArray[0]['user_fullname']));
                $failedRecipients = array(FAILED_EMAIL => FAILED_NAME);
                $this->registry->mailer->send($message, $failedRecipients);

                /* *************************** End: Send Email to the Expert Registered ************************* */

                $_SESSION['success'] = "The Request has been successfully marked as Called";
                General::redirect($_SERVER['HTTP_REFERER']);
            }
            else{
                $_SESSION['error'][] = "There was a problem processing the request";
                General::redirect($_SERVER['HTTP_REFERER']);
            }
        }
        else{
            General::redirect($_SERVER['HTTP_REFERER']);
        }
    }

}
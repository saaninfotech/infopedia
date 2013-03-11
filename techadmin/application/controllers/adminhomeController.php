<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index controller for the Admin Seciton
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 3:21 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class adminhomeController extends SaanController
{
    /**
     * @purpose: This is for the displaying the admin home page
     * @author: Rishabh Dev Bansal
     */
    public function index()
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center :Admin Home Page";
        $this->registry->template->show("adminhome");
    }

    /* ************************** Start: Functions Related to Category ****************************** */

    /**
     * @purpose: This is the Signout action
     * @author: Rishabh Dev Bansal
     */
    public function signout()
    {
        session_destroy();
        General::redirect(__SITE_URL);
    }

    /**
     * @purpose: This is the Action for the Add Category Page
     */
    public function add_category()
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center :Add Category";
        $this->registry->template->show("add_category");

    }

    /**
     * @purpose: This function adds a New Category in the Database
     * @author: Rishabh Dev Bansal
     */
    public function addExpertCategory()
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center :Add Category";
        if ($this->isPostBack()) {

            $postArray = $this->requestPost();

            /* *********************** Start: Validation of the Data from Post *********************** */

            if ($this->registry->validation->isEmpty($postArray['expert_category_name'])) {
                $_SESSION['error'][] = "Please Enter Category Name.";

            }

            if ($this->registry->validation->isEmpty($postArray['expert_category_description'])) {
                $_SESSION['error'][] = "Please Enter Category Discription.";

            }

            if ($this->getCategoryByName($postArray['expert_category_name']) > 0) {
                $_SESSION['error'][] = "This category is already registered.";
            }
            if (count($_SESSION['error']) == 0) {
                /* *********************** Start: Formation of the POST Array for Submission *********************** */
                $postData = array('expert_category_name' => $postArray['expert_category_name'],
                    'expert_category_description' => $postArray['expert_category_description'],
                    'expert_category_status' => "active"
                );

                /* *********************** End: Formation of the POST Array for Submission *********************** */
                $this->registry->model->run(addExpertCategory, $postData);
                $_SESSION['success'] = "Category Added Successfully";

            } else {

                $this->registry->template->PostRetain = $postArray;
            }


        }
        $this->registry->template->show("add_category");

    }


    /**
     * @purpose: This function gets the Category Array by category name
     * @author: Rishabh Dev Bansal
     * @param $name
     * @return mixed
     */
    public function getCategoryByName($name)
    {
        return $this->registry->model->run("getCategoryByName", $name);
    }

    /**
     * @purpose: This is the action for the View Category Page
     */
    public function view_category($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Category";
        $catDetailsArray = $this->registry->model->run("getAllCategoryDetails", $args);
        $this->registry->template->CatDetailsArray = $catDetailsArray;
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->show("view_category");

    }

    /**
     * @purpose: This function deletes any Category with Category Id
     * @author: Rishabh Dev Bansal
     * @param $args
     */
    public function deleteCat($args)
    {
        $id = $this->registry->security->decryptData($args['id']);
        $this->registry->model->run("deleteCat", $id);
        General::redirect(__SITE_URL . "adminhome/view_category");
        exit;

    }

    /**
     * @purpose: This function changes the status of any Category with the Category Id
     * @author: Rishabh Dev Bansal
     * @param $args
     */
    public function changeCategoryStatus($args)
    {
        $args['id'] = $this->registry->security->decryptData($args['id']);
        $args['status'] = $this->registry->security->decryptData($args['status']);
        $this->registry->model->run("changeCategoryStatus", $args);
        General::redirect(__SITE_URL . "adminhome/view_category");
        exit;
    }

    /* ************************** End: Functions Related to Category ****************************** */

    /* ************************** Start: Functions Related to Experts ****************************** */

    /**
     * @purpose: This is the action page for the View Experts Papge.
     * @author: Saurabh Sinha
     * @param $args
     */
    public function view_experts($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Experts";
        $expertListArray = $this->registry->model->run("getAllExpertsList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->ExpertListArray = $expertListArray;
        $this->registry->template->show("view_experts");
    }

    public function deleteExpert($args)
    {
        $expertId = $this->registry->security->decryptData($args['expert_id']);
        $this->registry->model->run('deleteExpert', $expertId);
        $_SESSION['success'] = "Expert Deleted Successfully";
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function activateExpert($args)
    {
        $expertId = $this->registry->security->decryptData($args['expert_id']);
        $this->registry->model->run('activateExpert', $expertId);
        $_SESSION['success'] = "Expert Activated Successfully";
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function deactivateExpert($args)
    {
        $expertId = $this->registry->security->decryptData($args['expert_id']);
        $this->registry->model->run('deactivateExpert', $expertId);
        $_SESSION['success'] = "Expert Deactivated Successfully";
        General::redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    public function getExpertIdByExpertEmail($emailAddress)
    {
        return $this->registry->model->run('getExpertIdByExpertEmail', $emailAddress);
    }


    /* ************************** End: Functions Related to Experts ****************************** */


    /* ************************** Start: Functions Related to Email Templates ****************************** */

    public function view_templates($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Email Templates";
        $templateListArray = $this->registry->model->run("getAllTemplateList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->TemplateListArray = $templateListArray;
        $this->registry->template->show("view_templates");
    }

    public function editTemplate($args)
    {
        if (is_array($args) && $args['template_id'] != '') {
            $templateId = $this->registry->security->decryptData($args['template_id']);
            $this->registry->template->Title = "Infopedia - Technical Support Center : EditEmail Templates";
            $templateArray = $this->registry->model->run("getTemplateByTemplateId", $templateId);
            if ($this->isPostBack()) {
                $postArray = $this->requestPost();
                foreach ($postArray as $postKey => $postValue) {
                    if ($this->registry->validation->isEmpty($postValue)) {
                        $controlName = ucwords(str_replace("_", " ", $postKey));
                        $_SESSION['error'][] = "$controlName cannot be left blank";
                    }
                }
                if (count($_SESSION['error']) == 0) {
                    $postArray['email_template_id'] = $templateId;
                    $this->registry->model->run('updateEmailTemplateById', $postArray);
                    $_SESSION['success'] = "Email Template updated successfully";
                    General::redirect($_SERVER['HTTP_REFERER']);
                    exit;
                }
            }

            foreach ($templateArray as $templateKey => $templateValue) {
                $this->registry->template->TemplateArray = $templateValue;
            }
            $this->registry->template->show("edit_template");
        }
    }

    /* ************************** End: Functions Related to Email Templates ****************************** */


    /* ************************** Start: Functions Related to Transactions ****************************** */

    public function view_transactions($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View all Transactions";
        $transactionListArray = $this->registry->model->run("getAllTransactionList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->TransactionListArray = $transactionListArray;
        $this->registry->template->show("view_transactions");
    }

    public function view_expert_earning($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Expert Earnings";
        $expertEarningListArray = $this->registry->model->run("getExpertTotalEarningList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->CustomerAmount = appController::getAppSettingBySettingName('amount_to_expert');
        $this->registry->template->ExpertEarningListArray = $expertEarningListArray;
        $this->registry->template->show("view_expert_earning");
    }


    public function view_expert_payment($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Expert Payment";
        $expertPaymentListArray = $this->registry->model->run("getExpertPaymentList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->ExpertPaymentListArray = $expertPaymentListArray;
        $this->registry->template->show("view_expert_payment");
    }


    public function view_app_setting($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View App Setting";
        $appSettingListArray = $this->registry->model->run("getAppSettingList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->AppSettingListArray = $appSettingListArray;
        $this->registry->template->show("view_app_setting");
    }

    public function editAppSetting($args)
    {
        if (is_array($args) && $args['app_setting_id'] != '') {
            $appSettingId = $this->registry->security->decryptData($args['app_setting_id']);
            $this->registry->template->Title = "Infopedia - Technical Support Center : Edit App Setting";
            $appSettingArray = $this->registry->model->run("getSettingBySettingId", $appSettingId);
            if ($this->isPostBack()) {
                $postArray = $this->requestPost();
                foreach ($postArray as $postKey => $postValue) {
                    if ($this->registry->validation->isEmpty($postValue)) {
                        $controlName = ucwords(str_replace("_", " ", $postKey));
                        $_SESSION['error'][] = "$controlName cannot be left blank";
                    }
                }
                if (count($_SESSION['error']) == 0) {
                    $postArray['app_setting_id'] = $appSettingId;
                    $this->registry->model->run('updateAppSettingById', $postArray);
                    $_SESSION['success'] = "App Setting updated successfully";
                    General::redirect($_SERVER['HTTP_REFERER']);
                    exit;
                }
            }

            foreach ($appSettingArray as $settingKey => $appSettingValue) {
                $this->registry->template->SettingArray = $appSettingValue;
            }
            $this->registry->template->show("edit_app_setting");
        }
    }


    public function view_payable_experts($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Payable Experts";
        if ($this->isPostBack()) {
            $postArray = $this->requestPost();
            if (is_array($postArray) && count($postArray['selected_experts']) > 0) {
                foreach ($postArray['selected_experts'] as $expertPaypalEmail => $expertPayAmount) {
                    $_SESSION['email'][] = $expertPaypalEmail;
                    $_SESSION['amount_value'][] = $expertPayAmount;
                }
                General::redirect(__SITE_URL . "application/controllers/test_payment.php");
            }
        }
        $payableExpertListArray = $this->registry->model->run("getAllPayableExperts", $args);
        $this->registry->template->CustomerAmount = appController::getAppSettingBySettingName('amount_to_expert');
        $this->registry->template->ExpertPayableListArray = $payableExpertListArray;
        $this->registry->template->show("view_payable_experts");
    }

    public function cancel_payment()
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : Cancel Payment Confirmation";
        if(count($_SESSION['email']) == count($_SESSION['amount_value']))
        {
            for($i = 0; $i < count($_SESSION['email']); $i++)
            {
                $finalArray[$_SESSION['email'][$i]] = $_SESSION['amount_value'][$i];
            }
            $this->registry->template->PaymentArray = $finalArray;
        }
        unset($_SESSION['email']);
        unset($_SESSION['amount_value']);
        $this->registry->template->show("cancel_payment");
    }

    public function payment_success()
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : Payment Success Confirmation";
        if(count($_SESSION['email']) == count($_SESSION['amount_value']))
        {
            $expertIdArray = array();
            foreach($_SESSION['email'] as $emailAddress)
            {
                $expertArray = $this->registry->model->run('getExpertIdByExpertPaypal', $emailAddress);
                $expertIdArray[] = $expertArray[0]['expert_id'];
            }
            for($i = 0; $i < count($_SESSION['email']); $i++)
            {
                $finalArray[$_SESSION['email'][$i]] = $_SESSION['amount_value'][$i];
                $insertPaymentArray[$expertIdArray[$i]] = $_SESSION['amount_value'][$i];
                $dataArray['data'][] = "(" . $expertIdArray[$i] . ", " . $_SESSION['amount_value'][$i] . ", " . time() . ")";
            }
            $dataArray['rows'] = array('expert_id', 'paid_amount', 'paid_datetime');

            //This logs the entry in the expert payment table for the payment done
            $this->registry->model->run('logExpertPayment', $dataArray);

            //This updates the amount due value for every expert in the amount due table.
            for($j = 0; $j < count($expertIdArray); $j++)
            {
                $amountDueArray = $this->registry->model->run('getAmountDueByExpertId', $expertIdArray[$j]);
                $newAmountDueValue = $amountDueArray[0]['amount_due_value'] - $_SESSION['amount_value'][$j];
                $args['amount_value'] = $newAmountDueValue;
                $args['expert_id'] = $expertIdArray[$j];
                $this->registry->model->run('updateAmountDue', $args);
            }

            $this->registry->template->PaymentArray = $finalArray;
        }
        unset($_SESSION['email']);
        unset($_SESSION['amount_value']);
        $this->registry->template->show("success_payment");
    }

    /* ************************** Start: Functions Related to Transactions ****************************** */


    /* ************************** Start: Functions Related to Expert Feedback ****************************** */

    public function view_expert_feedback($args)
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center : View Expert Feedbacks";
        $expertFeedbackListArray = $this->registry->model->run("getExpertFeedbackList", $args);
        $this->registry->template->PresentPage = $args['start_page'];
        $this->registry->template->ExpertFeedbackListArray = $expertFeedbackListArray;
        $this->registry->template->show("view_expert_feedback");
    }

    /* ************************** End: Functions Related to Expert Feedback ****************************** */
}

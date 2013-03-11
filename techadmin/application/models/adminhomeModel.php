<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index Model for the Admin Section of the SAAN Index Controller
 *
 * @author: Saurabh Sinha
 * @created on: 1/7/13 12:25 AM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class adminhomeModel extends SaanModel
{

    /* ************************ Start: Functions related to the Category ***************************** */


    /**
     * @purpose: This function Add a New Category in the Database
     * @author: Rishabh Dev Bansal
     * @param $postArray
     * @return mixed
     */
    public function addExpertCategory($postArray)
    {
        return $this->db->query_insert('expert_category_details', $postArray);
    }

    /**
     * @purpose: This is the function to get the Category with the Category Name.
     * @author: Saurabh Sinha
     * @param $name
     * @return mixed
     */
    public function getCategoryByName($name)
    {
        $getExpertCatQuery = "SELECT expert_category_id FROM expert_category_details WHERE expert_category_name = '$name'";
        return $this->db->num_rows($getExpertCatQuery);
    }

    /**
     * @purpose: This function gets all the Category in Paginated Form
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllCategoryDetails($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $getCatDetailsQuery = "SELECT * FROM expert_category_details ORDER BY expert_category_id DESC ";

        return $this->db->paginateQuery($getCatDetailsQuery, $start);
    }

    /**
     * @purpose: This is the function to delete the category with the Category ID
     * @author: Saurabh Sinha
     * @param $id
     * @return mixed
     */
    public function deleteCat($id)
    {
        $query = "DELETE FROM  expert_category_details WHERE expert_category_id = '$id'";
        return $this->db->query($query);
    }


    /**
     * @purpose: This function is responsible for the change of the Status of the Category in the Database.
     * @author: Rishabh Dev Bansal
     * @param $args
     * @return mixed
     */
    public function changeCategoryStatus($args)
    {
        $id = $args['id'];
        $status = $args ['status'];
        $status = ($status == "active") ? "inactive" : "active";
        $query = "UPDATE  expert_category_details SET expert_category_status = '$status' WHERE expert_category_id = '$id'";
        return $this->db->query($query);
    }

    /* ************************ End: Functions related to the Category ***************************** */

    /* ************************ Start: Functions related to the Experts ***************************** */

    /**
     * @purpose: This function returns the paginated array of all the Experts
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllExpertsList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT E.*, EC.expert_category_name FROM expert_details E INNER JOIN expert_category_details EC ON
                        E.expert_category_id = EC.expert_category_id ORDER BY E.expert_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    /**
     * @purpose: This function deletes the Expert By Expert Id
     * @author: Saurabh Sinha
     * @param $expertId
     * @return mixed
     */
    public function deleteExpert($expertId)
    {
        $query = "DELETE FROM expert_details WHERE expert_id = '$expertId'";
        return $this->db->query($query);
    }

    public function activateExpert($expertId)
    {
        $query = "UPDATE expert_details SET expert_status = 'active' WHERE expert_id = '$expertId'";
        return $this->db->query($query);
    }

    public function deactivateExpert($expertId)
    {
        $query = "UPDATE expert_details SET expert_status = 'inactive' WHERE expert_id = '$expertId'";
        return $this->db->query($query);
    }

    public function getExpertIdByExpertPaypal($emailAddress)
    {
        $query = "SELECT expert_id FROM expert_details WHERE expert_paypal = '$emailAddress'";
        return $this->db->fetch_rows($query);
    }

    /* ************************ End: Functions related to the Experts ***************************** */

    /* ************************ Start: Functions related to the Email Templates ***************************** */

    /**
     * @purpose: This function returns the paginated array of all the Email Templates
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllTemplateList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM email_template_details ORDER BY email_template_id DESC ";

        return $this->db->paginateQuery($query, $start);
    }

    /**
     * @param $templateId
     * @return mixed
     */
    public function getTemplateByTemplateId($templateId)
    {
        if ($templateId != '') {
            $query = "SELECT * FROM email_template_details WHERE email_template_id = '$templateId'";
            return $this->db->fetch_rows($query);
        }
    }


    /**
     * @param $emailArray
     * @return mixed
     */
    public function updateEmailTemplateById($emailArray)
    {
        if (is_array($emailArray)) {
            $templateSubject = $emailArray['template_subject'];
            $templateDescription = $emailArray['template_description'];
            $templateContent = $emailArray['template_content'];
            $templateStatus = $emailArray['template_status'];
            $query = "UPDATE email_template_details SET
                            email_template_subject = '$templateSubject',
                            email_template_description = '$templateDescription',
                            email_template_content = '$templateContent',
                            email_template_status = '$templateStatus'
                      WHERE email_template_id = '" . $emailArray['email_template_id'] . "'";
            return $this->db->query($query);
        }
    }

    /* ************************ End: Functions related to the Email Templates ***************************** */


    /* ************************ Start: Functions related to the Transactions ***************************** */

    /**
     * @purpose: This function gets the list of all the successfull transactions
     * @author: Saurabh Sinha
     * @param $args
     * @return mixed
     */
    public function getAllTransactionList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT T.*, E.expert_name,
                        U.user_email_address,
                        U.user_fullname,
                        U.user_phone_number
                        FROM advice_request_details U
                        INNER JOIN expert_details E
                            ON U.expert_id = E.expert_id
                        INNER JOIN advice_payment_details T
                            ON U.advice_request_id = T.advice_request_id";

        return $this->db->paginateQuery($query, $start);
    }


    /**
     * @param $args
     * @return mixed
     */
    public function getExpertTotalEarningList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT
                        E.expert_name,
                        E.expert_email,
                        E.expert_photo,
                        E.expert_phone_number,
                        EC.expert_category_name,
                        AD.amount_due_value,
                        COUNT(A.advice_request_id) AS total_advice
                    FROM advice_request_details A
                        INNER JOIN expert_details E
                            ON A.expert_id = E.expert_id
                        INNER JOIN expert_category_details EC
                            ON E.expert_category_id = EC.expert_category_id
                        INNER JOIN amount_due_details AD
                            ON E.expert_id = AD.expert_id
                    WHERE A.advice_request_payment_status = 'complete'
                    GROUP BY A.expert_id ";

        return $this->db->paginateQuery($query, $start);
    }



    /**
     * @param $args
     * @return mixed
     */
    public function getExpertPaymentList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT
                        E.expert_name,
                        E.expert_email,
                        E.expert_photo,
                        E.expert_phone_number,
                        EP.paid_amount FROM
                        expert_payment_details EP
                        INNER JOIN expert_details E
                        ON  EP.expert_id = E.expert_id";

        return $this->db->paginateQuery($query, $start);
    }


    /**
     * @param $args
     * @return mixed
     */
    public function updateAmountDueByExpertId($args)
    {
        $expertId = $args['expert_id'];
        $updateType = $args['update_type'];
        $subtractAmount = $args['subtract_amount'];
        $amountDueArray = $this->getAmountDueByExpertId($expertId);
        if ($updateType == "add") {
            $amountDueValue = $amountDueArray[0]['amount_due_value'] + appController::getAppSettingBySettingName('amount_to_expert');
        } else if ($updateType == "subtract") {
            $amountDueValue = $amountDueArray[0]['amount_due_value'] - $subtractAmount;
        }

        $query = "UPDATE amount_due_details SET amount_due_value = '$amountDueValue' WHERE expert_id = '$expertId'";
        return $this->db->query($query);
    }

    /**
     * @param $expertId
     * @return mixed
     */
    public function getAmountDueByExpertId($expertId)
    {
        $query = "SELECT amount_due_value FROM amount_due_details WHERE expert_id = '$expertId'";
        return $this->db->fetch_rows($query);
    }

    public function getAllPayableExperts()
    {
        $query = "SELECT E.expert_name,
                        E.expert_id,
                        E.expert_photo,
                        E.expert_paypal,
                        AD.amount_due_value
                        FROM expert_details E
                          INNER JOIN amount_due_details AD
                              ON E.expert_id = AD.expert_id
                        WHERE AD.amount_due_value > 0";

        return $this->db->fetch_rows($query);
    }

    public function logExpertPayment($dataArray)
    {
        return $this->db->multiple_insert('expert_payment_details', $dataArray);
    }

    public function updateAmountDue($args)
    {
        $query = "UPDATE amount_due_details
                        SET amount_due_value = '" . $args['amount_value'] . "'
                        WHERE expert_id = '" . $args['expert_id'] . "'";

        return $this->db->query($query);
    }


    /* ************************ End: Functions related to the Transactions ***************************** */



    /* ************************ Start: Functions related to the App Setting ***************************** */

    /**
     * @param $args
     * @return mixed
     */
    public function getAppSettingList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM app_setting_details WHERE 1";
        return $this->db->paginateQuery($query, $start);
    }

    /**
     * @param $appSettingId
     * @return mixed
     */
    public function getSettingBySettingId($appSettingId)
    {
        if ($appSettingId != '') {
            $query = "SELECT * FROM app_setting_details WHERE app_setting_id = '$appSettingId'";
            return $this->db->fetch_rows($query);
        }
    }


    /**
     * @param $settingArray
     * @return mixed
     */
    public function updateAppSettingById($settingArray)
    {
        if (is_array($settingArray)) {
            $settingValue = $settingArray['app_setting_value'];
            $query = "UPDATE app_setting_details SET
                            app_setting_value  = '$settingValue'
                      WHERE app_setting_id = '" . $settingArray['app_setting_id'] . "'";
            return $this->db->query($query);
        }
    }

    /* ************************ End: Functions related to the App Setting ***************************** */


    /* ************************ Start: Functions related to the Expert Feedback ***************************** */

    public function getExpertFeedbackList($args)
    {
        $start = 0;
        if (is_array($args) && isset($args['start_page'])) {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT
                      AF.*,
                      AR.user_fullname,
                      AR.user_email_address,
                      AR.user_phone_number,
                      E.expert_name
                    FROM
                      advice_request_details AR
                      INNER JOIN advice_feedback_details AF
                        ON AR.advice_request_id = AF.advice_id
                      INNER JOIN expert_details E
                        ON AR.expert_id = E.expert_id";

        return $this->db->paginateQuery($query, $start);
    }

    /* ************************ Start: Functions related to the Expert Feedback ***************************** */
}


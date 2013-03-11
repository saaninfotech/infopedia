<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose:
 *
 * @author: Rishabh Dev Bansal
 * @created on: 12/1/13 4:32 PM
 *
 */

/***********************************************************************/

class expertModel extends SaanModel
{

    public function getExpertByEmail($email)
    {
        $getExpertQuery = "SELECT * FROM expert_details WHERE expert_email = '$email' AND expert_status = 'active'";

        return $this->db->fetch_rows($getExpertQuery);
    }

    public function getCategoryList()
    {
        $getCatQuery = "SELECT expert_category_id, expert_category_name FROM expert_category_details
                            WHERE expert_category_status = 'active'";

        return $this->db->fetch_rows($getCatQuery);
    }

    public function updateExpertProfile($updateArray)
    {
        $updateQuery = "UPDATE expert_details SET
                            expert_category_id = '" . $updateArray['expert_category_id'] . "',
                            expert_name = '" . $updateArray['expert_name'] . "',
                            expert_address = '" . $updateArray['expert_address'] . "',
                            expert_phone_number = '" . $updateArray['expert_phone_number'] . "',
                            expert_paypal = '" . $updateArray['expert_paypal'] . "',
                            expert_credential_description = '" . $updateArray['expert_credential_description'] . "'

                            WHERE expert_email = '" . $updateArray['session_expert_email'] . "'";

        return $this->db->query($updateQuery);

    }

    public function validateOldPassword($credArray)
    {
        $query = "SELECT expert_id FROM expert_details WHERE
                        expert_email = '" . $credArray['expert_email'] . "'
                        AND expert_password = '" . $credArray['old_password'] . "'";

        return $this->db->num_rows($query);
    }

    public function updatePassword($credArray)
    {
        $query = "UPDATE expert_details
                    SET expert_password = '" . $credArray['new_password'] . "'
                    WHERE expert_email = '" . $credArray['expert_email'] . "'";

        return $this->db->query($query);
    }

    public function getCustomerListByExpertId($args)
    {
        $start = 0;
        if(is_array($args) && isset($args['start_page']))
        {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }

        $query = "SELECT * FROM advice_request_details WHERE expert_id = '" . $args['expert_id'] . "' AND advice_request_payment_status = 'complete' ORDER BY advice_request_id DESC";

        return $this->db->paginateQuery($query, $start);
    }

    public function getFeedbackListByExpertId($args)
    {
        $start = 0;
        if(is_array($args) && isset($args['start_page']))
        {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }

        $query = "SELECT F.*, R.expert_id, R.user_fullname, R.user_phone_number, R.user_email_address FROM advice_request_details R
                        INNER JOIN advice_feedback_details F
                            ON R.advice_request_id = F.advice_id
                        WHERE R.expert_id = '" . $args['expert_id'] . "' ORDER BY F.advice_feedback_id DESC";

        return $this->db->paginateQuery($query, $start);
    }

    public function updateCallStatus($adviceRequestId)
    {
        $query = "UPDATE advice_request_details SET
                        advice_request_status = 'called'
                    WHERE advice_request_id = '$adviceRequestId'";
        return $this->db->query($query);
    }

    public function getExpertEarningsByEmailId($args)
    {
        $start = 0;
        if(is_array($args) && isset($args['start_page']))
        {
            $start = $args['start_page'];
            $start = $start * RECORDS_PER_PAGE;
        }
        $query = "SELECT * FROM expert_payment_details WHERE expert_id = '" . $args['expert_id'] . "'";
        return $this->db->paginateQuery($query, $start);
    }

    public function getAdviceByAdviceId($adviceId)
    {
        $query = "SELECT * FROM advice_request_details WHERE advice_request_id = '$adviceId'";
        return $this->db->fetch_rows($query);
    }

    public function addFeedback($feedbackArray)
    {
        if(is_array($feedbackArray))
        {
            $this->db->query_insert('advice_feedback_details', $feedbackArray);
        }
    }

    public function getFeedbackByFeedbackId($feedbackId)
    {
        $query = "SELECT * FROM advice_feedback_details WHERE advice_feedback_id = '$feedbackId'";
        return $this->db->fetch_rows($query);
    }

    public function updateFeedbackRead($feedbackId)
    {
        $query = "UPDATE advice_feedback_details SET expert_read = 'yes' WHERE advice_feedback_id = '$feedbackId'";
        return $this->db->query($query);
    }

    public function updateAdviceCountByExpertId($expertId)
    {
        $query = "UPDATE expert_details SET expert_total_advice = expert_total_advice + 1 WHERE expert_id = '$expertId'";
        return $this->db->query($query);
    }
}
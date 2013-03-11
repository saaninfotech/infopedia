<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the SignUp Model for the SignUp Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 9/1/13 3:18 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class signupModel extends SaanModel
{

    public function registerExpert($postArray)
    {
        return $this->db->query_insert('expert_details', $postArray);
    }


    public function getExpertByEmailnCode($arg)
    {
        $expert_email = $arg['expert_email'];
        $active_code = $arg['active_code'];

        $getExpertQuery = "SELECT expert_status
								FROM expert_details
								WHERE expert_email = '$expert_email'
									AND expert_email_active_code = '$active_code'";

        return $this->db->fetch_rows($getExpertQuery);
    }

    public function activateExpert($arg)
    {
        $expert_email = $arg['expert_email'];
        $active_code = $arg['active_code'];

        $activateExpertQuery = "UPDATE expert_details
											SET expert_status = 'active',
											   	expert_email_active_date = '" . time() . "' WHERE expert_email = '$expert_email' AND expert_email_active_code = '$active_code'";

        return $this->db->query($activateExpertQuery);
    }

    /**
     * @purppose: This function is to get the email template for sending the mail.
     * @author: Saurabh Sinha
     *
     * @param $templateName
     *
     * @return mixed
     */
    /*public function getTemplateByName($templateName)
    {
        $getTemplateQuery = "SELECT * FROM email_template_details WHERE email_template_name = '$templateName' and email_template_status = 'active'";

        return $this->db->fetch_rows($getTemplateQuery);
    }*/

    /**
     * @purpose: This function returns the List fo Category id and corresponding category name.
     * @author: Saurabh Sinha
     * @return mixed
     */
    public function getCategoryList()
    {
        $categoryQuery = "SELECT expert_category_id, expert_category_name FROM expert_category_details WHERE expert_category_status = 'active'";

        return $this->db->fetch_rows($categoryQuery);
    }

    public function getExpertByEmail($emailAddress)
    {
        $getExpertQuery = "SELECT expert_id FROM expert_details WHERE expert_email = '$emailAddress'";

        return $this->db->num_rows($getExpertQuery);
    }

    public function updateExpertPic($arg)
    {
        $query = "UPDATE expert_details SET expert_photo = '" . $arg . ".jpg' WHERE expert_id = '$arg'";

        return $this->db->query($query);
    }

    public function insertAmountDueTable($args)
    {
        if(is_array($args))
        {
            return $this->db->query_insert('amount_due_details', $args);
        }
    }
}

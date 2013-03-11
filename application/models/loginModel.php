<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the Login Model for the Login Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 9/1/13 3:17 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class loginModel extends SaanModel
{
    public function expertLogin($postArray)
    {
        $expert_email = $postArray['user_login'];
        $expert_password = md5($postArray['password']);

        $loginQuery = "SELECT expert_id
							FROM  expert_details
							WHERE expert_email = '$expert_email'
								AND expert_password = '$expert_password'
								AND expert_status = 'active'";

        return $this->db->fetch_rows($loginQuery);

    }

    public function getUserByEmail($emailAddress)
    {
        $query = "SELECT expert_name, expert_status FROM expert_details WHERE expert_email = '$emailAddress'";
        return $this->db->fetch_rows($query);
    }

    public function updatePasswordByEmail($updateArray)
    {
        $query = "UPDATE expert_details SET expert_password = '" . $updateArray['new_password'] . "' WHERE expert_email = '" . $updateArray['forgot_email'] . "'";
        return $this->db->query($query);
    }
}

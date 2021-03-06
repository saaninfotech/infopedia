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
class indexController extends SaanController
{
    public function index()
    {
        $this->registry->template->Title = "Infopedia - Technical Support Center :Admin Section";
        $this->registry->template->ErrorLogin = "style=\"display:none;\"";
        $this->registry->template->show("index");
    }

    public function login()
    {
        if ($this->isPostBack()) {
            $postArray = $this->requestPost();
        }

        if (($this->registry->model->run('checkAdminByIdnPass', $postArray)) > 0) {
            $_SESSION['adminLogin'] = $adminArgs['txtUsername'];
            header("Location: " . __SITE_URL . "adminhome");
        } else {
            $this->registry->template->ErrorLogin = "style=\"display:block;\"";
        }
        $this->registry->template->show("index");
    }
}

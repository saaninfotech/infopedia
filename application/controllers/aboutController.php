<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the Index controller for the Framework
 *
 * @author: Rishabh Dev Bansal
 * @created on: 12/30/12 3:21 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class aboutController extends SaanController
{
    public function index()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center:About Us";
        $this->registry->template->show("about");
    }


}

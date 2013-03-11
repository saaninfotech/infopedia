<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 1/15/13 8:51 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class searchController extends SaanController
{
    public function index()
    {

    }

    public function performSearch()
    {
        if ($this->isPostBack()) {
            $searchValue = $this->requestPost();
            $searchedExpertArray = $this->registry->model->run('searchExpertByCredential', $searchValue['search_text']);
            $this->registry->template->ExpertListLatest = $searchedExpertArray;
            $this->registry->template->SearchTerm = $searchValue['search_text'];
            $this->registry->template->show('search_experts');
        }
        else {
            $this->registry->template->show('search_experts');
        }
    }
}

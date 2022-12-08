<?php
namespace App\Controllers\Frontend;
use App\Models\HomeModel;
use App\Models\ServiceModel;
use App\Models\AboutModel;
use App\Models\WorkModel;
use App\Models\TestimonialModel;
use App\Models\InfoModel;
use App\Models\ContactModel;
use App\Models\FeedbackModel;
use App\Controllers\BaseController;

class Frontend extends BaseController
{
    function __construct()
    {
        $this->HomeModel = new HomeModel();
        $this->ServiceModel = new ServiceModel();
        $this->AboutModel = new AboutModel();
        $this->WorkModel = new WorkModel();
        $this->TestimonialModel = new TestimonialModel();
        $this->InfoModel = new InfoModel();
        $this->ContactModel = new ContactModel();
        $this->FeedbackModel = new FeedbackModel();
    }

    function index()
    {
        $data = [];

        $data['categories'] = $this->ServiceModel->getCategory()->getResult();

        $data['getHomeTitle'] = $this->HomeModel->getHomeTitle()->getResult();

        $data['getServicesTitle'] = $this->ServiceModel->getServicesTitle()->getResult();

        $data['getAboutsTitle'] = $this->AboutModel->getAboutsTitle()->getResult();

        $data['getWorksTitle'] = $this->WorkModel->getWorksTitle()->getResult();

        $data['getInfoList'] = $this->InfoModel->getInfoList()->getResult();

        $data['readProfessions'] = $this->TestimonialModel->getProfessions()->getResult();

        $data['readTestimonials'] = $this->TestimonialModel->readTestimonials()->getResult();
        
        $data['templateJudul'] = 'Gbvrj Solutions Technology | We help people build extraordinary apps';

        $i = 0;

        foreach ($data['getHomeTitle'] as $homeTitle) {
            $data['homeTitleList'][$i]['title'] = $homeTitle->title;
            $data['homeTitleList'][$i]['quote'] = $homeTitle->quote;
            $data['homeTitleList'][$i]['list'] = $this->HomeModel->getListHome($homeTitle->title)->getResultArray();
            $i++;
        }

        foreach ($data['getServicesTitle'] as $serviceTitle) {
            $data['servicesTitleList'][$i]['title'] = $serviceTitle->title;
            $data['servicesTitleList'][$i]['quotes'] = $serviceTitle->quotes;
            $data['servicesTitleList'][$i]['list'] = $this->ServiceModel->getListServices($serviceTitle->title)->getResultArray();
            $i++;
        }

        foreach ($data['getAboutsTitle'] as $aboutTitle) {
            $data['aboutsTitleList'][$i]['title'] = $aboutTitle->title;
            $data['aboutsTitleList'][$i]['quote'] = $aboutTitle->quote;
            $data['aboutsTitleList'][$i]['list'] = $this->AboutModel->getListAbouts($aboutTitle->title)->getResultArray();
            $i++;
        }

        foreach ($data['getWorksTitle'] as $workTitle) {
            $data['worksTitleList'][$i]['title'] = $workTitle->title;
            $data['worksTitleList'][$i]['quote'] = $workTitle->quote;
            $data['worksTitleList'][$i]['list'] = $this->WorkModel->getListWorks($workTitle->title)->getResultArray();
            $i++;
        }
       
        /** Layout Header */
        echo view('frontend/layout_header', $data);

        /** Layout Sidebar */
        echo view('frontend/layout_sidebar', $data);

        /** Dashboard */
        echo view('frontend/index', $data);

        /** Layout Footer */
        echo view('frontend/layout_footer', $data);
    }

    function postContact()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name cannot be empty'
                    ],
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email cannot be empty'
                    ],
                ],
                'subject' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Subject cannot be empty'
                    ],
                ],
                'message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Message cannot be empty'
                    ],
                ],
            ];

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'name'     => $this->request->getVar('name'),
                    'email'     => $this->request->getVar('email'),
                    'subject'     => $this->request->getVar('subject'),
                    'message' => $this->request->getVar('message'),
                ];
                $action = $this->ContactModel->insertContact($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Successfully sending message');
                    return redirect()->to(base_url());
                } else {
                    session()->setFlashdata('warning', 'Unsuccessfully sending message');
                    return redirect()->to(base_url());
                }
            }
        }

          /** Layout Header */
          echo view('frontend/layout_header', $data);

          /** Layout Sidebar */
          echo view('frontend/layout_sidebar', $data);
  
          /** Dashboard */
          echo view('frontend/index', $data);
  
          /** Layout Footer */
          echo view('frontend/layout_footer', $data);
    }

    function postFeedback()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $data = $this->request->getVar();

            $rulles = [
                'name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Name cannot be empty'
                    ],
                ],
                'email' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Email cannot be empty'
                    ],
                ],
                'message' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Message cannot be empty'
                    ],
                ],
            ]; 

            if (!$this->validate($rulles)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $record = [
                    'name'     => $this->request->getVar('name'),
                    'email'     => $this->request->getVar('email'),
                    'message'     => $this->request->getVar('message'),
                ];
                $action = $this->FeedbackModel->insertFeedback($record);
                if ($action != false) {
                    $id = $action;
                    session()->setFlashdata('success', 'Successfully sending feedback');
                    return redirect()->to(base_url());
                } else {
                    session()->setFlashdata('warning', 'Unsuccessfully sending feedback');
                    return redirect()->to(base_url());
                }
            }
        }

          /** Layout Header */
          echo view('frontend/layout_header', $data);

          /** Layout Sidebar */
          echo view('frontend/layout_sidebar', $data);
  
          /** Dashboard */
          echo view('frontend/index', $data);
  
          /** Layout Footer */
          echo view('frontend/layout_footer', $data);
    }
}

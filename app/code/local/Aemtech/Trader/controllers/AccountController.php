<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerController
 *
 * @author niranjan
 */
require_once 'Mage/Customer/controllers/AccountController.php';

class Aemtech_Trader_Customer_AccountController extends Mage_Customer_AccountController {

    /**
     * Login post action
     */
    public function loginPostAction() {

        if (!$this->_validateFormKey()) {
            $this->_redirect('*/*/');
            return;
        }

        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session = $this->_getSession();

        if ($this->getRequest()->isPost()) {
            $login = $this->getRequest()->getPost('login');
            if (!empty($login['username']) && !empty($login['password'])) {
                try {
                    $session->login($login['username'], $login['password']);
                    /* Check if the customer is in Trader-Temp group if so he can't login yet */
                    $groups = Mage::getSingleton('customer/group')->getCollection()->addFieldToFilter("customer_group_code", 'Trader-Temp');

                    $groupID = 1;
                    if ($groups && count($groups) > 0) {
                        foreach ($groups as $preRegGroup) {
                            $groupID = $preRegGroup->getId();
                            break;
                        }
                    }
                    $customergrp = $session->getCustomer()->getGroupId();
                    $IsActivated = $session->getCustomer()->getIsactivated();

                    if ($IsActivated === "0") {
                        $session->logout()->renewSession();
                        $session->addError($this->__('Your account has not been approved. We will send you an email once your registration has been approved.'));
                        $url = $this->_getUrl('*/*/index', array('_secure' => true));
                        $this->_redirectError($url);
                        return;
                    }

                    if ($session->getCustomer()->getIsJustConfirmed()) {
                        $this->_welcomeCustomer($session->getCustomer(), true);
                    }
                } catch (Mage_Core_Exception $e) {
                    switch ($e->getCode()) {
                        case Mage_Customer_Model_Customer::EXCEPTION_EMAIL_NOT_CONFIRMED:
                            $value = $this->_getHelper('customer')->getEmailConfirmationUrl($login['username']);
                            $message = $this->_getHelper('customer')->__('This account is not confirmed. <a href="%s">Click here</a> to resend confirmation email.', $value);
                            break;
                        case Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD:
                            $message = $e->getMessage();
                            break;
                        default:
                            $message = $e->getMessage();
                    }

                    $session->addError($message);
                    $session->setUsername($login['username']);
                } catch (Exception $e) {
                    // Mage::logException($e); // PA DSS violation: this exception log can disclose customer password
                }
            } else {
                $session->addError($this->__('Login and password are required.'));
            }
        }

        $this->_loginPostRedirect();
    }

    public function createPostAction() {
        // echo "Reached Here::Correct";die();
        /** @var $session Mage_Customer_Model_Session */
        $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }
        $session->setEscapeMessages(true); // prevent XSS injection in user input
        if (!$this->getRequest()->isPost()) {
            $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
            $this->_redirectError($errUrl);
            return;
        }

        $postparams = $this->getRequest()->getParams();
        $data = array(
            'secret' => "6LdQGSgUAAAAAOpEk2tKNtHBmCmXTvt2tkFEsVnu",
            'response' => $postparams['g-recaptcha-response']
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        $response_arr = json_decode($response, true);

        if($response_arr['success']!==true && $postparams['formtype']!="trader") {
            Mage::getSingleton('customer/session')->addError(Mage::helper('captcha')->__('Incorrect CAPTCHA.'));
            $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));         
            $this->_redirectError($errUrl);
            return;   
        }

        $formId = 'trader_register';
        $captchaModel = Mage::helper('captcha')->getCaptcha($formId);
        if ($captchaModel->isRequired()) {
            $postparams = $this->getRequest()->getParams();
            $formtype = $postparams['formtype'];
            $userCaptcha = $this->_getCaptchaString($this->getRequest(), $formId);
            if (!$captchaModel->isCorrect($userCaptcha)) {
                Mage::getSingleton('customer/session')->addError(Mage::helper('captcha')->__('Incorrect CAPTCHA.'));
                $this->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);
                $session->setCustomerFormData($this->getRequest()->getPost());
                if ($formtype == "trader") {
                    $errUrl = $this->_getUrl('trader/index', array('_secure' => true));
                    $this->_redirectError($errUrl);
                    return;
                } else {
                    $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
                }
            }
        }


        $customer = $this->_getCustomer();
        /**
         * Initialize customer group id
         */
        try {
            $usergroup = $this->getRequest()->getPost('group');

            if (!empty($usergroup) && $usergroup == 'Trader-Temp') {

                $groups = Mage::getSingleton('customer/group')->getCollection()->addFieldToFilter("customer_group_code", $usergroup);

                $groupID = 1;
                if ($groups && count($groups) > 0) {
                    foreach ($groups as $preRegGroup) {
                        $groupID = $preRegGroup->getId();
                        break;
                    }
                }

                $customer->setGroupId($groupID);
                $customer->setIstrader(1);
                $customer->setIsactivated(0);
                $taxvat = $this->getRequest()->getPost('taxvat');
                $customer->setTaxvat($taxvat);
            }

            //Mage::log("Customer Group set to".$groupID);
        } catch (Exception $ex) {
            Mage::logException($ex);
        }
        try {
            $errors = $this->_getCustomerErrors($customer);

            if (empty($errors)) {
                $customer->save();		
				
				$cid = $customer->getId();
				/* Upload ACRA document(pdf) */
				if (isset($_FILES['uploadacrapdf']['name']) && $_FILES['uploadacrapdf']['name'] != '') {
					try {	
						$uploader = new Varien_File_Uploader('uploadacrapdf');
						$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png','pdf'));
						$uploader->setAllowRenameFiles(false);
						$uploader->setFilesDispersion(false);
						//$path = Mage::getBaseDir('media') . DS;
						$path = Mage::getBaseDir('media') . DS . 'trader' . DS;
						//$fileName = $_FILES['uploadacrapdf']['name'];
						$ext = explode('.', $_FILES['uploadacrapdf']['name']);
					    $ext = array_pop($ext);
				
						$fileName = 'trader_'.$cid.'.'.$ext;
						$uploader->save($path, $fileName);
						
					} catch (Exception $e) {
						
					}
				}
				/* End Upload ACRA document(pdf) */
				
				
                $this->_dispatchRegisterSuccess($customer);
                $this->_successProcessRegistration($customer);
                return;
            } else {
                $this->_addSessionError($errors);
            }
        } catch (Mage_Core_Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                $url = $this->_getUrl('customer/account/forgotpassword');
                $message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
                $session->setEscapeMessages(false);
            } else {
                $message = $e->getMessage();
            }
            //$session->addError($message);
            Mage::getSingleton('customer/session')->addError(Mage::helper('catalog')->__($message));
            if (!empty($usergroup) && $usergroup == 'Trader-Temp' && !empty($message)) {
                $errUrl = $this->_getUrl('trader/index', array('_secure' => true));
            } else {
                $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
            }
            $this->_redirectError($errUrl);
        } catch (Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost())
                    ->addException($e, $this->__('Cannot save the customer.'));
        }
        if (empty($message)) {
            if (!empty($usergroup) && $usergroup == 'Trader-Temp' && !empty($errors)) {
                $errUrl = $this->_getUrl('trader/index', array('_secure' => true));
            } else {
                $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));
            }
        } else {
            $this->_addSessionError($message);
        }

        $this->_redirectError($errUrl);
    }

    protected function _getCaptchaString($request, $formId) {
        $captchaParams = $request->getPost(Mage_Captcha_Helper_Data::INPUT_NAME_FIELD_VALUE);
        return $captchaParams[$formId];
    }

    /**
     * Customer register form page
     */
    public function createAction() {
        if ($this->_getSession()->isLoggedIn()) {
            $this->_redirect('*/*');
            return;
        }

        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->renderLayout();
    }

    /**
     * Success Registration
     *
     * @param Mage_Customer_Model_Customer $customer
     * @return Mage_Customer_AccountController
     */
    protected function _successProcessRegistration(Mage_Customer_Model_Customer $customer) {
        $session = $this->_getSession();

        $groups = Mage::getSingleton('customer/group')->getCollection()->addFieldToFilter("customer_group_code", "Trader-Temp");
        $groupID = 1;
        if ($groups && count($groups) > 0) {
            foreach ($groups as $preRegGroup) {
                $groupID = $preRegGroup->getId();
                break;
            }
        }
        if ($customer->isConfirmationRequired() && $customer->getGroupId() != $groupID) {
            /** @var $app Mage_Core_Model_App */
            $app = $this->_getApp();
            /** @var $store  Mage_Core_Model_Store */
            $store = $app->getStore();
            $customer->sendNewAccountEmail(
                    'confirmation', $session->getBeforeAuthUrl(), $store->getId()
            );
            $customerHelper = $this->_getHelper('customer');

            $session->addSuccess($this->__('Account confirmation is required. Please, check your email for the confirmation link. To resend the confirmation email please <a href="%s">click here</a>.', $customerHelper->getEmailConfirmationUrl($customer->getEmail())));
            $url = $this->_getUrl('*/*/index', array('_secure' => true));
        } elseif ($customer->getGroupId() == $groupID) {
            /** @var $app Mage_Core_Model_App */
            $app = $this->_getApp();
            /** @var $store  Mage_Core_Model_Store */
            $store = $app->getStore();
            $customer->sendNewAccountEmail(
                    'traderregister', $session->getBeforeAuthUrl(), $store->getId()
            );
            Mage::getSingleton('core/session')->getMessages(true);
            $session->addSuccess($this->__('You have successfully registered an account with us and a sales representative will get back to you within 2 business days. Once you have been approved as a Monogram Tea customer, you may begin the process of purchasing our products online.'));
            $url = $this->_getUrl('*/*/index', array('_secure' => true));
			
			//PG: Send notification to admin
			$emailTemplate = Mage::getModel('core/email_template')->loadDefault('notification_for_new_customer');
			$emailTemplate
			->setSenderName(Mage::getStoreConfig('trans_email/ident_support/name'))
			->setSenderEmail(Mage::getStoreConfig('trans_email/ident_support/email'))
			->setTemplateSubject('New Trader Registered');
			
			$emailTemplateVariables['username']= $customer->getFirstname().' '.$customer->getLastname();
			$emailTemplateVariables['customer_email'] = $customer->getEmail();

			$result = $emailTemplate->send(Mage::getStoreConfig('trans_email/ident_general/email'),Mage::getStoreConfig('trans_email/ident_general/name'), $emailTemplateVariables);
			//PG End
			
			
        } else {
            $session->setCustomerAsLoggedIn($customer);
            $url = $this->_welcomeCustomer($customer);
        }
        $this->_redirectSuccess($url);
        return $this;
    }

}

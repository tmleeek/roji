<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArtisanController
 *
 * @author mumate
 */
class Aemtech_Subscriptions_ArtisanController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    { 
        $this->loadLayout();
        $this->renderLayout();
        //echo "Hello All";exit;
    }
}

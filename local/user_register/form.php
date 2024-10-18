<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin functions for the local_[pluginname] plugin.
 *
 * @package   local_user_register
 * @copyright 2024, Paris Charalampidis
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();


/**
 * Plugin functions for the local_[pluginname] plugin.
 *
 * @package   local_user_register
 * @copyright 2024, Paris Charalampidis
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 require_once("config.php");
 require_once("$CFG->libdir/formslib.php");

 class user_register_form extends moodleform{

    public function definition(){
        //a form component is gene   
        $mform = $this->_form;
        //this blocks handle the generation of form elements.      
        $mform->addElement('email', 'email', get_string('email'));
        $mform->addElement('text', 'firstname', get_string('firstname'));
        $mform->addElement('text', 'lastname',get_string('lastname'));
        $mform->addElement('text', 'country', get_string('country'));
        $mform->addElement('text', 'mobile_phone', get_string('mobile_phone'));

        $mform->addElement('submit',get_string('submit'));
        //this block handles  the type of elements.
        $mform->setType('email',PARAM_EMAIL);
        $mform->setType('firstname',PARAM_NOTAGS);
        $mform->setType('lastname',PARAM_NOTAGS);
        $mform->setType('country', PARAM_NOTAGS);
        $mform->setType('mobile_phone', PARAM_NOTAGS);
        //this blocke generates a default message.
        $mform->setDefault('email','Please enter a username');
        $mform->setDefault('firstname','Please enter a firstname');
        $mform->setDefault('lastname','Please enter a lastname');
        $mform->setDefault('country','Please enter a country');
        $mform->setDefault('mobile_phone','Please enter a mobile phone');
        //this block handles requirement at the form fields.
        $mform->addRule('email',null,'required',null,'client');
        $mform->addRule('firstname',null,'required',null,'client');
        $mform->addRule('lastname',null,'required',null,'client');
        $mform->addRule('country',null,'required',null,'client');
        $mform->addRule('mobile_phone',null,'required',null,'client');
    }
    
    public function validation(){
    
 }
 };


?>
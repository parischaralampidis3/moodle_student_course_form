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

require_once("$CFG->libdir/formslib.php");

class user_register_form extends moodleform
{

    public function definition()
    {
        //a form component is gene   
        $mform = $this->_form;
        //initiate an array for a set of buttons
        $buttonarray = [];
        //this blocks handle the generation of form elements.      
        $mform->addElement('email', 'email', get_string('email','local_user_register'));
        $mform->addElement('text', 'firstname', get_string('firstname','local_user_register'));
        $mform->addElement('text', 'lastname', get_string('lastname','local_user_register'),);
        $mform->addElement('text', 'country', get_string('country','local_user_register'),);
        $mform->addElement('text', 'mobile_phone', get_string('mobile_phone','local_user_register'));

        //this block handles  the type of elements.
        $mform->setType('email', PARAM_EMAIL);
        $mform->setType('firstname', PARAM_NOTAGS);
        $mform->setType('lastname', PARAM_NOTAGS);
        $mform->setType('country', PARAM_NOTAGS);
        $mform->setType('mobile_phone', PARAM_NOTAGS);

        //this block handles requirement at the form fields.
        $mform->addRule('email', null, 'required', null, 'client');
        $mform->addRule('firstname', null, 'required', null, 'client');
        $mform->addRule('lastname', null, 'required', null, 'client');
        $mform->addRule('country', null, 'required', null, 'client');
        $mform->addRule('mobile_phone', null, 'required', null, 'client');

        //an array of buttons is set for save and cancel funtioncalities
        $buttonarray[] = &$mform->createElement('submit', 'submitbutton', get_string('savechanges'));
        $buttonarray[] = &$mform->createElement('cancel', 'cancelbutton', get_string('cancel'));
        
        $mform->addGroup($buttonarray, 'buttonarr', '', array(''), false);
        $mform->closeHeaderBefore('buttonarr');
    }
    
    public function validation($data, $files)
    //this block adds a logic for validating the form fields and display errors
    {
        $errors = [];
        //validate email
        if (empty($data['email'])) {
            $errors['email'] = get_string('emailisrequired', 'local_user_register');
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = get_string('emailinvalid', 'local_user_register');
        }
        //validate firstname
        if (empty($data['firstname'])) {
            $errors['firstname'] = get_string('firstnameisrequired', 'local_user_register');
        }

        //validate lastname
        if (empty($data['lastname'])) {
            $errors['lastname'] = get_string('lastnameisrequired', 'local_user_register');
        }

        //validate country
        if (empty($data['country'])) {
            $errors['country'] = get_string('countryisrequired', 'local_user_register');
        }

        //validate phone number

        if (empty($data['mobile_phone'])) {
            $errors['mobile_phone'] = get_string('mobilephoneisrequired', 'local_user_register');
        } else if (!is_numeric($data['mobile_phone'])) {
            $errors['mobile_phone'] = get_string('phonenumbermustbenumeric', 'local_user_register');
        }
        //the error array is retured after the conditional logic
        return $errors;
    }
};

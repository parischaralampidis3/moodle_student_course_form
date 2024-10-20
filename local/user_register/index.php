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

// Ensure the configuration and environment are loaded.

use core\output\html_writer;

require_once(__DIR__ . "/../../config.php");

// Require the user to be logged in.
require_login();

// Set the context for the current page. 
$context = context_system::instance(); // Use the system context; adjust as needed.
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/user_register/index.php'));
$PAGE->set_title(get_string('user_register', 'local_user_register'));
$PAGE->set_heading(get_string('user_register', 'local_user_register'));

// Fetching form functionality from form file at the local plugin
require_once($CFG->dirroot . "/local/user_register/form.php");
//fetcing file for fetch user
require_once($CFG->dirroot . "/local/user_register/fetch_user_data.php");

$user_data = fetch_user_data();

// Initiation of a moodle form.
$mform = new user_register_form();

// Set a guard condition if the form is canceled.
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . "/local/user_register/index.php");
} else if ($data = $mform->get_data()) {

//initiate global database variable
    global $DB;
//initiat a new moodle class
    $record = new StdClass();
//use the parameter $data to fetch the form data and save at the class for each field.
    $record->email = $data->email;
    $record->firstname = $data->firstname;
    $record->lastname = $data->lastname;
    $record->country = $data->country;
    $record->mobilephone = !empty($data->mobile_phone) ? $data->mobile_phone : null;
    $record->timecreated = time();

    $DB->insert_record('user_register',$record);

    $message = [];
    // This method displays the form at the view
    $message[] = get_string('submitformmessage', 'local_user_register');
}

// Display header
echo $OUTPUT->header();
$mform->display();

if(!empty($user_data)){
    echo html_writer::start_tag('table',['class'=>'user_data_table']);

    echo html_writer::start_tag('tr');

    echo html_writer::tag('th','Email');
    echo html_writer::tag('th', 'First Name');
    echo html_writer::tag('th', 'Last Name');
    echo html_writer::tag('th', 'Country');
    echo html_writer::tag('th','Mobile Phone');

    foreach($user_data as $user){
        echo html_writer::start_tag('tr');
        
        echo html_writer::tag('td' , $user->email);
        echo html_writer::tag('td' , $user->firstname);
        echo html_writer::tag('td', $user->lastname);
        echo html_writer::tag('td', $user->country);
        echo html_writer::tag('td', $user->mobile_phone);

        echo html_writer::end_tag('tr');
    }

    echo html_writer::end_tag('tr');

    echo html_writer::end_tag('table');
}else{
    echo html_writer::tag('p', 'no user found');
}

if (!empty($message)) {
    echo html_writer::tag('div', $message[0], ['class' => 'alert alert']);
}


echo $OUTPUT->footer();

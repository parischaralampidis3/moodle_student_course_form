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

// Initiation of a moodle form.
$mform = new user_register_form();

// Set a guard condition if the form is canceled.
if ($mform->is_cancelled()) {
    redirect($CFG->wwwroot . "/local/user_register/index.php");
} else if ($data = $mform->get_data()) {
    $message = [];
    // This method displays the form at the view
    $message[] = get_string('submitformmessage', 'local_user_register');
}

// Display header
echo $OUTPUT->header();

if (!empty($message)) {
    echo html_writer::tag('div', $message[0], ['class' => 'alert alert']);
}

$mform->display();
echo $OUTPUT->footer();

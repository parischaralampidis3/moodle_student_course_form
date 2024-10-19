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
 * You may have settings in your plugin
 *
 * @package    local_userRegister
 * @copyright  2014 Surya Pratap
 * @license    http://www.gnu.org/copyleft/gpl.html gnu gpl v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $ADMIN -> add('localplugins',new admin_category('user_register_category',get_string('pluginname','local_user_register')));

    $settingspage = new admin_settingpage('user_register_settings', get_string('pluginname','local_user_register'));

    $settingspage->add(new admin_setting_configtext(
        'local_user_register/setting_user_register',
        get_string('user_register','local_user_register'),
        get_string('user_description','local_user_register'),
        "",
        PARAM_TEXT
    ));

}
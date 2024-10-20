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

// Ensure that this file is included only in the Moodle context.
defined('MOODLE_INTERNAL') || die();

/**
 * Extend the global navigation with a custom link to the user register form.
 *
 * @param global_navigation $nav The global navigation object.
 */

function local_user_register_extend_navigation(global_navigation $nav) {
    global $PAGE;

    // Check if the current page type is either 'site-index' (homepage) or 'my-index' (dashboard)
    if ($PAGE->pagetype === 'site-index' || $PAGE->pagetype === 'my-index') {
        // Add a node (link) to the navigation
        $node = $nav->add(
            get_string('user_register', 'local_user_register'),  // Link text
            new moodle_url('/local/user_register/index.php'),   // URL for the link
            navigation_node::TYPE_CUSTOM                        // Type of link (custom link)
        );

        // Set a tooltip for the link
        if ($node) {
            $node->title = get_string('registertooltip', 'local_user_register');
        }
    }
}

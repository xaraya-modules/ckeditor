<?php
/**
 * Main user function, entry point
 * @package modules
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link http://www.xaraya.com

 * @subpackage CKEditor Module
 * @link http://www.xaraya.com/index.php/release/eid/1166
 * @author Marc Lutolf <mfl@netspan.ch> and Ryan Walker <ryan@webcommunicate.net>
 */

function ckeditor_user_main(array $args = [], $context = null)
{
    // Security Check
    if (!xarSecurity::check('ReadCKEditor')) {
        return;
    }

    return [];
}

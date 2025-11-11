<?php

/**
 * @package modules\ckeditor
 * @category Xaraya Web Applications Framework
 * @version 2.5.7
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link https://github.com/mikespub/xaraya-modules
**/

namespace Xaraya\Modules\Ckeditor\AdminGui;

use Xaraya\Modules\Ckeditor\AdminGui;
use Xaraya\Modules\MethodClass;

/**
 * ckeditor admin overview function
 * @extends MethodClass<AdminGui>
 */
class OverviewMethod extends MethodClass
{
    /** functions imported by bermuda_cleanup */

    /**
     * Module overview
     * @package modules
     * @copyright see the html/credits.html file in this release
     * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
     * @link http://www.xaraya.com
     * @subpackage CKEditor Module
     * @link http://www.xaraya.com/index.php/release/eid/1166
     * @author Marc Lutolf <mfl@netspan.ch> and Ryan Walker <ryan@webcommunicate.net>
     * @see AdminGui::overview()
     */
    public function __invoke(array $args = [])
    {
        if (!$this->sec()->checkAccess('ReadCKEditor')) {
            return;
        }

        $data = [];

        // success
        $data['context'] ??= $this->getContext();
        return $this->mod()->template('overview', $data);
    }
}

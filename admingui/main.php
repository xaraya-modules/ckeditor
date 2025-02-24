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
use xarSecurity;
use xarServer;
use xarModVars;
use xarController;
use xarRequest;
use sys;
use BadParameterException;

sys::import('xaraya.modules.method');

/**
 * ckeditor admin main function
 * @extends MethodClass<AdminGui>
 */
class MainMethod extends MethodClass
{
    /** functions imported by bermuda_cleanup */

    /**
     * Main admin function, entry point
     * @package modules
     * @copyright see the html/credits.html file in this release
     * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
     * @link http://www.xaraya.com
     * @subpackage CKEditor Module
     * @link http://www.xaraya.com/index.php/release/eid/1166
     * @author Marc Lutolf <mfl@netspan.ch> and Ryan Walker <ryan@webcommunicate.net>
     * @see AdminGui::main()
     */
    public function __invoke(array $args = [])
    {
        if (!$this->sec()->checkAccess('AdminCKEditor')) {
            return;
        }

        $samemodule = xarController::isRefererSameModule();

        if ($this->mod('modules')->getVar('disableoverview') == 0 || $samemodule) {
            $this->ctl()->redirect($this->mod()->getURL('admin', 'overview'));
        } else {
            $this->ctl()->redirect($this->mod()->getURL('admin', 'modifyconfig'));
        }
        // success
        return true;
    }
}

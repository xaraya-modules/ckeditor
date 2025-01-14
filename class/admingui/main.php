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
     */
    public function __invoke(array $args = [])
    {
        if (!$this->checkAccess('AdminCKEditor')) {
            return;
        }

        $request = new xarRequest();
        $refererinfo =  xarController::$request->getInfo(xarServer::getVar('HTTP_REFERER'));
        $request = new xarRequest();
        $info =  xarController::$request->getInfo();
        $samemodule = $info[0] == $refererinfo[0];

        if (xarModVars::get('modules', 'disableoverview') == 0 || $samemodule) {
            $this->redirect($this->getUrl('admin', 'overview'));
        } else {
            $this->redirect($this->getUrl('admin', 'modifyconfig'));
        }
        // success
        return true;
    }
}

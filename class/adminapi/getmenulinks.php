<?php

/**
 * @package modules\ckeditor
 * @category Xaraya Web Applications Framework
 * @version 2.5.7
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link https://github.com/mikespub/xaraya-modules
**/

namespace Xaraya\Modules\Ckeditor\AdminApi;


use Xaraya\Modules\Ckeditor\AdminApi;
use Xaraya\Modules\MethodClass;
use xarSecurity;
use xarController;
use sys;
use BadParameterException;

sys::import('xaraya.modules.method');

/**
 * ckeditor adminapi getmenulinks function
 * @extends MethodClass<AdminApi>
 */
class GetmenulinksMethod extends MethodClass
{
    /** functions imported by bermuda_cleanup */

    /**
     * getmenulinks
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
        $menulinks = [];

        if (xarSecurity::check('AdminCKEditor', 0)) {
            $menulinks[] = ['url'   => xarController::URL(
                'ckeditor',
                'admin',
                'modifyconfig'
            ),
                'title' => xarML('Modify Configuration'),
                'label' => xarML('Modify Configuration'), ];
        }

        if (xarSecurity::check('AdminCKEditor', 0)) {
            $menulinks[] = ['url'   => xarController::URL(
                'ckeditor',
                'admin',
                'overview'
            ),
                'title' => xarML('Module Overview'),
                'label' => xarML('Overview'),
                'active' => ['main'], ];
        }

        return $menulinks;
    }
}

<?php

/**
 * @package modules\ckeditor
 * @category Xaraya Web Applications Framework
 * @version 2.5.7
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link https://github.com/mikespub/xaraya-modules
**/

namespace Xaraya\Modules\Ckeditor\UserApi;


use Xaraya\Modules\Ckeditor\UserApi;
use Xaraya\Modules\MethodClass;
use sys;

sys::import('xaraya.modules.method');

/**
 * ckeditor userapi getmenulinks function
 * @extends MethodClass<UserApi>
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
     * @link http://www.xaraya.com/index.php/release/eid/
     * @author Marc Lutolf <mfl@netspan.ch> and Ryan Walker <ryan@webcommunicate.net>
     * @see UserApi::getmenulinks()
     */
    public function __invoke(array $args = [])
    {
        $menulinks = [];

        if ($this->sec()->checkAccess('ViewCKEditor', 0)) {
            $menulinks[] = ['url'   => $this->mod()->getURL('user', 'main'),
                'title' => $this->ml(''),
                'label' => $this->ml(''), ];
        }

        return $menulinks;
    }
}

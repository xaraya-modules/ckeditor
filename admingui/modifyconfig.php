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
use Xaraya\Modules\Ckeditor\AdminApi;
use Xaraya\Modules\MethodClass;
use sys;

sys::import('xaraya.modules.method');

/**
 * ckeditor admin modifyconfig function
 * @extends MethodClass<AdminGui>
 */
class ModifyconfigMethod extends MethodClass
{
    /** functions imported by bermuda_cleanup */

    /**
     * Modify configuration
     * @package modules
     * @copyright see the html/credits.html file in this release
     * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
     * @link http://www.xaraya.com
     * @subpackage CKEditor Module
     * @link http://www.xaraya.com/index.php/release/eid/1166
     * @author Marc Lutolf <mfl@netspan.ch> and Ryan Walker <ryan@webcommunicate.net>
     * @see AdminGui::modifyconfig()
     */
    public function __invoke(array $args = [])
    {
        /** @var AdminApi $adminapi */
        $adminapi = $this->adminapi();
        // Security Check
        if (!$this->sec()->checkAccess('AdminCKEditor')) {
            return;
        }
        $this->var()->find('phase', $phase, 'str:1:100', 'modify');

        switch (strtolower($phase)) {
            case 'modify':
                break;

            case 'update':

                // Confirm authorisation code
                if (!$this->sec()->confirmAuthKey()) {
                    return;
                }

                /*$this->var()->find('itemsperpage', $itemsperpage, 'int', $this->mod()->getVar('itemsperpage'));
                $this->var()->find('shorturls', $shorturls, 'checkbox', false);
                $this->var()->find('modulealias', $useModuleAlias, 'checkbox', $this->mod()->getVar('useModuleAlias'));
                $this->var()->find('aliasname', $aliasname, 'str', $this->mod()->getVar('aliasname'));*/

                $pgrconfig = [
                    'rootPath' => 'str',
                    'urlPath' => 'str',
                    'allowedExtensions' => 'str',
                    //'imagesExtensions' => 'str',
                    'fileMaxSize' => 'int',
                    'imageMaxHeight' => 'int',
                    'imageMaxWidth' => 'int',
                    'allowEdit' => 'str',
                ];

                foreach ($pgrconfig as $key => $type) {
                    $setting = 'PGRFileManager_' . $key;
                    $this->var()->find($setting, ${$setting}, $type, $this->mod()->getVar($setting));

                    if ($key == 'imagesExtensions' || $key == 'allowedExtensions') {
                        ${$setting} = str_replace(' ', '', ${$setting});
                        $arr = explode(',', ${$setting});
                        $end = end($arr);
                        if (empty($end)) {
                            array_pop($arr);
                        }
                        ${$setting} = implode(', ', $arr);
                    }

                    $this->mod()->setVar($setting, ${$setting});
                    $adminapi->modifypluginsconfig([
                        'name' => 'PGRFileManager.' . $key,
                        'value' => ${$setting},
                    ]);
                }

                $this->ctl()->redirect($this->mod()->getURL('admin', 'modifyconfig'));
                // Return
                return true;
        }
        $data['authid'] = $this->sec()->genAuthKey();
        return $data;
    }
}

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
use xarVar;
use xarSec;
use xarModVars;
use xarMod;
use xarController;
use sys;
use BadParameterException;

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
     */
    public function __invoke(array $args = [])
    {
        // Security Check
        if (!$this->checkAccess('AdminCKEditor')) {
            return;
        }
        if (!$this->fetch('phase', 'str:1:100', $phase, 'modify', xarVar::NOT_REQUIRED, xarVar::PREP_FOR_DISPLAY)) {
            return;
        }

        switch (strtolower($phase)) {
            case 'modify':
                break;

            case 'update':

                // Confirm authorisation code
                if (!$this->confirmAuthKey()) {
                    return;
                }

                /*if (!$this->fetch('itemsperpage', 'int', $itemsperpage, $this->getModVar('itemsperpage'), xarVar::NOT_REQUIRED, xarVar::PREP_FOR_DISPLAY)) return;
                if (!$this->fetch('shorturls', 'checkbox', $shorturls, false, xarVar::NOT_REQUIRED)) return;
                if (!$this->fetch('modulealias', 'checkbox', $useModuleAlias,  $this->getModVar('useModuleAlias'), xarVar::NOT_REQUIRED)) return;
                if (!$this->fetch('aliasname', 'str', $aliasname,  $this->getModVar('aliasname'), xarVar::NOT_REQUIRED)) return;*/

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
                    if (!$this->fetch($setting, $type, ${$setting}, $this->getModVar($setting), xarVar::NOT_REQUIRED)) {
                        return;
                    }

                    if ($key == 'imagesExtensions' || $key == 'allowedExtensions') {
                        ${$setting} = str_replace(' ', '', ${$setting});
                        $arr = explode(',', ${$setting});
                        $end = end($arr);
                        if (empty($end)) {
                            array_pop($arr);
                        }
                        ${$setting} = implode(', ', $arr);
                    }

                    xarModVars::set('ckeditor', $setting, ${$setting});
                    xarMod::apiFunc('ckeditor', 'admin', 'modifypluginsconfig', [
                        'name' => 'PGRFileManager.' . $key,
                        'value' => ${$setting},
                    ]);
                }

                $this->redirect($this->getUrl('admin', 'modifyconfig'));
                // Return
                return true;
                break;
        }
        $data['authid'] = $this->genAuthKey();
        return $data;
    }
}

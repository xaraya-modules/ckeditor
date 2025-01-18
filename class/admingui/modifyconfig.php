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
        if (!$this->sec()->checkAccess('AdminCKEditor')) {
            return;
        }
        if (!$this->var()->find('phase', $phase, 'str:1:100', 'modify')) {
            return;
        }

        switch (strtolower($phase)) {
            case 'modify':
                break;

            case 'update':

                // Confirm authorisation code
                if (!$this->sec()->confirmAuthKey()) {
                    return;
                }

                /*if (!$this->var()->find('itemsperpage', $itemsperpage, 'int', $this->mod()->getVar('itemsperpage'))) return;
                if (!$this->var()->find('shorturls', $shorturls, 'checkbox', false)) return;
                if (!$this->var()->find('modulealias', $useModuleAlias, 'checkbox', $this->mod()->getVar('useModuleAlias'))) return;
                if (!$this->var()->find('aliasname', $aliasname, 'str', $this->mod()->getVar('aliasname'))) return;*/

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
                    if (!$this->var()->find($setting, ${$setting}, $type, $this->mod()->getVar($setting))) {
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

                    $this->mod()->setVar($setting, ${$setting});
                    xarMod::apiFunc('ckeditor', 'admin', 'modifypluginsconfig', [
                        'name' => 'PGRFileManager.' . $key,
                        'value' => ${$setting},
                    ]);
                }

                $this->ctl()->redirect($this->mod()->getURL('admin', 'modifyconfig'));
                // Return
                return true;
                break;
        }
        $data['authid'] = $this->sec()->genAuthKey();
        return $data;
    }
}

<?php

/**
 * Handle module installer functions
 *
 * @package modules\ckeditor
 * @category Xaraya Web Applications Framework
 * @version 2.5.7
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link https://github.com/mikespub/xaraya-modules
**/

namespace Xaraya\Modules\Ckeditor;

use Xaraya\Modules\InstallerClass;
use xarMasks;
use xarPrivileges;
use xarModVars;
use xarServer;
use xarMod;
use sys;
use Exception;

sys::import('xaraya.modules.installer');

/**
 * Handle module installer functions
 *
 * @todo add extra use ...; statements above as needed
 * @todo replaced ckeditor_*() function calls with $this->*() calls
 * @extends InstallerClass<Module>
 */
class Installer extends InstallerClass
{
    /**
     * Configure this module - override this method
     *
     * @todo use this instead of init() etc. for standard installation
     * @return void
     */
    public function configure()
    {
        $this->objects = [
            // add your DD objects here
            //'ckeditor_object',
        ];
        $this->variables = [
            // add your module variables here
            'hello' => 'world',
        ];
        $this->oldversion = '2.4.1';
    }

    /** xarinit.php functions imported by bermuda_cleanup */

    /**
     * Initialise or remove the ckeditor module
     */
    public function init()
    {
        # --------------------------------------------------------
        #
        # Set up masks
        #
        xarMasks::register('ViewCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_OVERVIEW');
        xarMasks::register('ReadCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_READ');
        xarMasks::register('CommentCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_COMMENT');
        xarMasks::register('ModerateCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_MODERATE');
        xarMasks::register('EditCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_EDIT');
        xarMasks::register('AddCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_ADD');
        xarMasks::register('ManageCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_DELETE');
        xarMasks::register('AdminCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_ADMIN');

        # --------------------------------------------------------
        #
        # Set up privileges
        #
        xarPrivileges::register('ViewCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_OVERVIEW');
        xarPrivileges::register('ReadCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_READ');
        xarPrivileges::register('CommentCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_COMMENT');
        xarPrivileges::register('ModerateCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_MODERATE');
        xarPrivileges::register('EditCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_EDIT');
        xarPrivileges::register('AddCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_ADD');
        xarPrivileges::register('ManageCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_DELETE');
        xarPrivileges::register('AdminCKEditor', 'All', 'ckeditor', 'All', 'All', 'ACCESS_ADMIN');

        # --------------------------------------------------------
        #
        # Set up modvars
        #
        //$this->setModVar('itemsperpage', 20);
        //$this->setModVar('useModuleAlias',0);
        //$this->setModVar('aliasname','CKEditor');
        //$this->setModVar('defaultmastertable','ckeditor_ckeditor');

        if (strstr(realpath(sys::varpath()), '/')) {
            $str = '/uploads';
        } else {
            $str = '\uploads';
        }
        $PGRFileManager_rootPath = realpath(sys::varpath()) . $str;
        $PGRFileManager_urlPath = xarServer::getBaseURL() . 'var/uploads';

        $this->setModVar('PGRFileManager_rootPath', $PGRFileManager_rootPath);
        $this->setModVar('PGRFileManager_urlPath', $PGRFileManager_urlPath);
        $this->setModVar('PGRFileManager_allowedExtensions', 'pdf, txt, rtf, jpg, gif, jpeg, png');
        $this->setModVar('PGRFileManager_imagesExtensions', 'jpg, gif, jpeg, png, bmp');
        $this->setModVar('PGRFileManager_fileMaxSize', 1024 * 1024 * 10);
        $this->setModVar('PGRFileManager_imageMaxHeight', 724);
        $this->setModVar('PGRFileManager_imageMaxWidth', 1280);
        $this->setModVar('PGRFileManager_allowEdit', 'true');

        xarMod::apiFunc('ckeditor', 'admin', 'modifypluginsconfig', [
            'name' => 'PGRFileManager.rootPath',
            'value' => $PGRFileManager_rootPath,
        ]);
        xarMod::apiFunc('ckeditor', 'admin', 'modifypluginsconfig', [
            'name' => 'PGRFileManager.urlPath',
            'value' => $PGRFileManager_urlPath,
        ]);

        // Add variables like this next one when creating utility modules
        // This variable is referenced in the xaradmin/modifyconfig-utility.php file
        // This variable is referenced in the xartemplates/includes/defaults.xd file
        //    $this->setModVar('bar', 'Bar');

        return true;
    }

    public function upgrade($oldversion)
    {
        return true;
    }

    public function delete()
    {
        $this_module = 'ckeditor';
        return xarMod::apiFunc('modules', 'admin', 'standarddeinstall', ['module' => $this_module]);
    }
}

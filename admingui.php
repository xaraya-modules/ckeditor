<?php

/**
 * @package modules\ckeditor
 * @category Xaraya Web Applications Framework
 * @version 2.5.7
 * @copyright see the html/credits.html file in this release
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 * @link https://github.com/mikespub/xaraya-modules
 **/

namespace Xaraya\Modules\Ckeditor;

use Xaraya\Modules\AdminGuiClass;
use sys;

sys::import('xaraya.modules.admingui');
sys::import('modules.ckeditor.adminapi');

/**
 * Handle the ckeditor admin GUI
 *
 * @method mixed main(array $args)
 * @method mixed modifyconfig(array $args)
 * @method mixed overview(array $args)
 * @extends AdminGuiClass<Module>
 */
class AdminGui extends AdminGuiClass
{
    // ...
}

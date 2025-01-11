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

use Xaraya\Modules\UserGuiClass;
use sys;

sys::import('xaraya.modules.usergui');
sys::import('modules.ckeditor.class.userapi');

/**
 * Handle the ckeditor user GUI
 *
 * @method mixed main(array $args)
 * @extends UserGuiClass<Module>
 */
class UserGui extends UserGuiClass
{
    /**
     * User main GUI function
     * @param array<string, mixed> $args
     * @return array<mixed>
     */
    public function main(array $args = [])
    {
        $args['description'] ??= 'Description of ckeditor';

        // Pass along the context for xarTpl::module() if needed
        $args['context'] ??= $this->getContext();
        return $args;
    }
}

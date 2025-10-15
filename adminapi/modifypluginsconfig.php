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
use sys;

sys::import('xaraya.modules.method');

/**
 * ckeditor adminapi modifypluginsconfig function
 * @extends MethodClass<AdminApi>
 */
class ModifypluginsconfigMethod extends MethodClass
{
    /** functions imported by bermuda_cleanup */

    /**
     * modify the plugins config file
     * @package modules
     * @copyright see the html/credits.html file in this release
     * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
     * @link http://www.xaraya.com
     * @subpackage CKEditor Module
     * @link http://www.xaraya.com/index.php/release/eid/1166
     * @author Marc Lutolf <mfl@netspan.ch> and Ryan Walker <ryan@webcommunicate.net>
     * @see AdminApi::modifypluginsconfig()
     */
    public function __invoke(array $args = [])
    {
        extract($args);

        $pluginsConfigFile = sys::code() . 'modules/ckeditor/config.plugins.php';
        $config_php = join('', file($pluginsConfigFile));

        $config_php = preg_replace('/\[\'' . $name . '\'\]\s*=\s*(\'|\")(.*)\\1;/', "['" . $name . "'] = '$value';", $config_php);

        $fp = fopen($pluginsConfigFile, 'wb');
        fwrite($fp, $config_php);
        fclose($fp);

        return true;
    }
}

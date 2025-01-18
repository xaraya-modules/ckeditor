<?php
/**
 *
 * Version information
 *
 */
$modversion['name']           = 'ckeditor';
$modversion['id']             = '30066';
$modversion['version']        = '2.2.0';
$modversion['displayname']    = xarMLS::translate('CKEditor');
$modversion['description']    = xarMLS::translate('A WYSIWYG editor module');
$modversion['credits']        = 'credits.txt';
$modversion['help']           = 'help.txt';
$modversion['changelog']      = 'changelog.txt';
$modversion['license']        = 'license.txt';
$modversion['official']       = false;
$modversion['author']         = 'Marc Lutolf';
$modversion['contact']        = 'http://www.netspan.ch/';
$modversion['admin']          = true;
$modversion['user']           = false;
$modversion['class']          = 'Complete';
$modversion['category']       = 'Utility';
$modversion['securityschema'] = [];
//$modversion['namespace']      = 'Xaraya\Modules\CKEditor';
$modversion['twigtemplates']  = true;
$modversion['dependencyinfo'] = [
    0 => [
        'name' => 'Xaraya Core',
        'version_ge' => '2.4.1',
    ],
];

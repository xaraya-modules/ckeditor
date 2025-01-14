<?php

/**
 * Handle getconfig hook calls
 *
 */

function ckeditor_adminapi_getconfighook(array $args = [], $context = null)
{
    extract($args);
    if (!isset($extrainfo['tabs'])) {
        $extrainfo['tabs'] = [];
    }
    $module = 'ckeditor';
    $tabinfo = [
        'module'  => $module,
        'configarea'  => 'general',
        'configtitle'  => $this->translate('CKEditor'),
        'configcontent' => '',
    ];
    $extrainfo['tabs'][] = $tabinfo;
    return $extrainfo;
}

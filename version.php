<?php

/**
 *
 * Version information
 *
 */

namespace Xaraya\Modules\Ckeditor;

class Version
{
    /**
     * Get module version information
     *
     * @return array<string, mixed>
     */
    public function __invoke(): array
    {
        return [
            'name' => 'ckeditor',
            'id' => '30066',
            'version' => '2.2.0',
            'displayname' => 'CKEditor',
            'description' => 'A WYSIWYG editor module',
            'credits' => 'credits.txt',
            'help' => 'help.txt',
            'changelog' => 'changelog.txt',
            'license' => 'license.txt',
            'official' => false,
            'author' => 'Marc Lutolf',
            'contact' => 'http://www.netspan.ch/',
            'admin' => true,
            'user' => false,
            'class' => 'Complete',
            'category' => 'Utility',
            'securityschema'
             => [
             ],
            'namespace' => 'Xaraya\\Modules\\Ckeditor',
            'twigtemplates' => true,
            'dependencyinfo'
             => [
                 0
                  => [
                      'name' => 'Xaraya Core',
                      'version_ge' => '2.4.1',
                  ],
             ],
        ];
    }
}

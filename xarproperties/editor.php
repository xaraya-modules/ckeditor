<?php

/**
 * Editor GUI property
 *
 * @package modules
 * @copyright (C) 2009 Netspan AG
 * @license GPL {@link http://www.gnu.org/licenses/gpl.html}
 *
 */

/**
 * Handle the editor property
 * Utilizes JavaScript based WYSIWYG Editor, CKEditor
 *
 * @author M. Lutolf (mfl@netspan.ch)
 * @package modules
 */

class EditorProperty extends TextAreaProperty
{
    public $id         = 30091;
    public $name       = 'editor';
    public $desc       = 'Editor';
    public $reqmodules = ['ckeditor'];

    public $editor     = null;
    public $version;

    public function __construct(ObjectDescriptor $descriptor)
    {
        parent::__construct($descriptor);
        $this->tplmodule = 'ckeditor';
        $this->template  = 'editor';
        $this->filepath  = 'modules/ckeditor/xarproperties';
        $this->version = $this->mod()->getVar('editorversion');
    }

    public function showInput(array $data = [])
    {
        if ($this->version == 'fckeditor') {
            // @todo no idea where this is now
            sys::import('modules.ckeditor.xartemplates.includes.ckeditor.ckeditor');
            $editorpath = sys::code() . 'modules/ckeditor/xartemplates/includes/ckeditor/';
            $name = $this->getCanonicalName($data);
            $this->editor = new \CKeditor($name) ;
            $this->editor->BasePath = $editorpath;
            $this->editor->Value = $this->value;
            $data['editor'] = $this->editor;
        }
        $data['version'] = $this->version;
        return parent::showInput($data);
    }
}

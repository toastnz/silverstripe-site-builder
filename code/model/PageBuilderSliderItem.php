<?php

/**
 * Class PageBuilderSliderItem
 *
 * @property int SortOrder
 * @property string Caption
 * @method PageBuilderItem PageBuilderItem
 * @method Image Image
 */
class PageBuilderSliderItem extends DataObject
{

    /**
     * @var array
     */
    private static $db = array(
        'SortOrder' => 'Int',
        'Caption' => 'HTMLText'
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'PageBuilderItem' => 'PageBuilderItem',
        'Image' => 'Image'
    );

    /**
     * @var string
     */
    private static $singular_name = 'Slide';

    /**
     * @var string
     */
    private static $plural_name = 'Slides';

    /**
     * @var array
     */
    public static $summary_fields = array(
        'Thumbnail' => 'Thumbnail'
    );

    /**
     * @var string
     */
    private static $default_sort = 'SortOrder';

    /**
     * @return mixed
     */
    public function getCMSValidator()
    {
        return RequiredFields::create(array(
            'Image'
        ));
    }

    /**
     * @return string
     */
    protected function getThumbnail()
    {
        if ($Image = $this->Image()->ID) {
            return $this->Image()->SetWidth(80);
        } else {
            return '(No Image)';
        }
    }

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        /** =========================================
         * @var FieldList $fields
         * @var Uploadfield $image
         * @var HtmlEditorField $caption
        ===========================================*/

        $fields = FieldList::create(TabSet::create('Root'));

        $fields->addFieldToTab('Root.Main', HeaderField::create('', 'Slide'));
        $fields->addFieldToTab('Root.Main', $image = UploadField::create('Image'));
        $image->setFolderName('Uploads/site-builder/slider');
        $image->setAllowedExtensions(array(
            'jpg',
            'jpeg',
            'gif',
            'png'
        ));
        $fields->addFieldToTab('Root.Main', LiteralField::create('',
            '<div class="message"><p><strong>Note:</strong> Captions are optional</p></div>'
        ));
        $fields->addFieldToTab('Root.Main', $caption = HtmlEditorField::create('Caption'));
        $caption->setRows(15);

        return $fields;
    }

    /**
     * On Before Write
     */
    protected function onBeforeWrite()
    {
        /** Set SortOrder */
        if (!$this->SortOrder) {
            $this->SortOrder = DataObject::get($this->ClassName)->max('SortOrder') + 1;
        }
        parent::onBeforeWrite();
    }

}

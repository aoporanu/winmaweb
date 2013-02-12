<?php

class Cms_Image {
    
    protected $img = null;
    
    protected $width = 100;
    protected $height = 100;
    
    protected $location = '';
    
    protected $for = 'campsite';
    protected $obj = null;
    
    public function __construct($tmpName, $location, $obj, $for = 'product') {
        $this->img = $tmpName;
        $this->location = $location;
        $this->for = $for;
        $this->obj = $obj;
    }
    
    public function setWidth($width) {
        $this->width = $width;
    }
    
    public function setheight($height) {
        $this->height = $height;
    }
    
    public function createImage($options = array()) {
        $origImage = WideImage::loadFromFile($this->img);
        $newImg = $origImage->resize($this->width, $this->height, 'outside', 'down');
        if($newImg) {
            //db
            if($this->for == 'product') {
                $q = Doctrine_Query::create()
                    ->update('ProductMedia')
                    ->addWhere('product_id = ?', $this->obj->id)
                    ->addWhere('type = ?', 'image')
                    ->set('main', 0)
                    ->execute();
                $media = new ProductMedia();
                $media->file_name = $options['fileName'];
                $media->dir = $this->location;
                $media->main = 1;
                $media->ext = 'jpg';
                
                $this->obj->ProductMedia->add($media);
                $this->obj->ProductMedia->save();
                $id = $media->get('id');
            }
            
            if($this->for == 'user') {
                $q = Doctrine_Query::create()
                    ->update('UserMedia')
                    ->addWhere('user_id = ?', $this->obj->id)
                    ->addWhere('type = ?', 'image')
                    ->set('main', 0)
                    ->execute();
                $media = new UserMedia();
                $media->file_name = $options['fileName'];
                $media->dir = $this->location;
                $media->main = 1;
                $media->ext = 'jpg';
                
                $this->obj->UserMedia->add($media);
                $this->obj->UserMedia->save();
                $id = $media->get('id');
            }
            
            if($this->for == 'charity') {
                $q = Doctrine_Query::create()
                    ->update('CharityMedia')
                    ->addWhere('charity_id = ?', $this->obj->id)
                    ->addWhere('type = ?', 'image')
                    ->set('main', 0)
                    ->execute();
                $media = new CharityMedia();
                $media->file_name = $options['fileName'];
                $media->dir = $this->location;
                $media->main = 1;
                $media->ext = 'jpg';
                
                $this->obj->CharityMedia->add($media);
                $this->obj->CharityMedia->save();
                $id = $media->get('id');
            }
            
            $newImg->saveToFile(ROOT_PATH . $this->location . '/' . $options['fileName'] . '_' . $id . '.jpg', 100);
            foreach($options['thumbs'] AS $thumb) {
                $thumbImg = $newImg->resize($thumb['width'], $thumb['height'], 'outside', 'down');
                $thumbImg = $thumbImg->resizeCanvas($thumb['width'], $thumb['height'], 'center', 'middle', 'ffffff', 'any');
                $thumbImg->saveToFile(ROOT_PATH . $thumb['dir'] . '/' . $options['fileName'] . '_' . $id . '.jpg', 100);
            }
        }
    }
    
}
<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Reseller Entity
 *
 * @property int $id
 * @property string $org_name
 * @property bool $status
 * @property string $image_path
 * @property string $image_name
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $is_deleted
 *

 * @property \App\Model\Entity\ResellerProgram[] $reseller_programs

 * @property \App\Model\Entity\User[] $users
 */
class Reseller extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    // protected function _getImageUrl()
    // {
    //     if(isset($this->_properties['image_name']) && !empty($this->_properties['image_name'])) {
    //         $url = Router::url('/reseller_images/'.$this->_properties['image_name'],true);
    //     }else{
    //         $url = Router::url('/img/default-img.jpeg',true);
    //     }
    //     return $url;

    // }

     protected function _getImageUrl()
    {
        if(isset($this->_properties['image_name']) && !empty($this->_properties['image_name'])) {
            $url = Router::url('/reseller_images/'.$this->_properties['image_name'],true);
        }else{
            $url = Router::url('/img/default-img.jpeg',true);
        }
        return $url;

    }
}
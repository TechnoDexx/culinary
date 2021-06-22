<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\HttpKernel;
use Vich\UploaderBundle\Event\Events;
use Vich\UploaderBundle\Event\Event;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use App\Entity\Recipes;

class VichImageHandling
{
	private $dest_dir;
	private $filename='';
	private $filepath;
	private $imagine;

	private const MAX_WIDTH=227;
	private const MAX_HEIGHT=166;

	// public function __construct(Event $event)
	// {
	// 	$this->imagine = new Imagine();
	// 	$this->filename = $event->getObject();
	// }

	public function resizeImage(Event $event, string $pathname)
	{
		$filepath=$event->getMapping();
		$filename=$event->getObject();
		dump($filepath);
		dump($filename);

		list($iwidth, $iheight) = getimagesize($filename);
	        $ratio = $iwidth / $iheight;
	        $width = self::MAX_WIDTH;
	        $height = self::MAX_HEIGHT;
	        if ($width / $height > $ratio) {
	            $width = $height * $ratio;
	        } else {
	            $height = $width / $ratio;
	        }

	        $photo = $this->imagine->open($filename);
	        $photo->resize(new Box($width, $height))->save($filename);
	}

}

<?php


namespace App\EventListener;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Common\EventSubscriber;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{
    /**
     * @var CacheManager
     */
    private $cacheManager;

    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;

    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
    {
        $this->cacheManager = $cacheManager;
        $this->uploaderHelper = $uploaderHelper;
    }

    public function getSubscribedEvents()
    {
        return [
            'preRemove',
            'preUpdate',
        ];
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        if ($entity instanceof Event) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
            return;
        }
        if ($entity instanceof User) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'avatarFile'));
            return;
        }
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getEntity();
        if ($entity instanceof Event) {
            if ($entity->getImageFile() instanceof UploadedFile) {
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
            }
            return;
        }
        if ($entity instanceof User) {
            if ($entity->getAvatarFile() instanceof UploadedFile) {
                $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'avatarFile'));
            }
            return;
        }
    }
}
<?php
declare(strict_types=1);
namespace App\Domain\ServicePack;

use App\Domain\ServicePackId;

interface ServicePackRepositoryInterface 
{
    /**
     * @param ServicePackName $name
     * @return ServicePack|null
     */
    public function findByName(ServicePackName $name): ?ServicePack;

    /**
     * @param ServicePackId $id
     * @return ServicePack
     */
    public function get(ServicePackId $id): ServicePack;
}
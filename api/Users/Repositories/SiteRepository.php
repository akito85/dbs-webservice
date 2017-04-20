<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Site;
use Infrastructure\Database\Eloquent\Repository;

class SiteRepository extends Repository
{
    public function getModel()
    {
        return new Site();
    }

    public function create(array $data)
    {
        $site = $this->getModel();

        $site->fill($data);
        $site->save();

        return $site;
    }

    public function update(Site $site, array $data)
    {
        $site->fill($data);

        $site->save();

        return $site;
    }
}
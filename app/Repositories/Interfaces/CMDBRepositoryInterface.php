<?php

namespace App\Repositories\Interfaces;

interface CMDBRepositoryInterface
{
    public function getBycategoryId($categoryId);
    public function store(array $data);
    public function export($categoryId);
    public function import($file);
}

<?php


namespace App\Repositories\Interfaces;


interface RepositoryInterface
{
    public function getAll();

    public function findById(int $id);

    public function create($item);

    public function update($item);

    public function delete(int $id);
}

<?php

namespace App\Interface;

interface OtpRepoInterface
{
    public function index();
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function findemail($email);
}

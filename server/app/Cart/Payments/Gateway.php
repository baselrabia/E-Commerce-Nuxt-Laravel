<?php

namespace App\Cart\Payments;

use App\Models\User;

interface Gateway
{

    public function withUser(User $user);
    public function user();
    public function createCustomer();

}
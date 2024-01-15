<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        // All users can view categories
        return true;
    }
    
    public function view(User $user, Category $category)
    {
        // All users can view categories
        return true;
    }
    
    public function create(User $user)
    {
        // Only admin users can create categories
        return $user->hasRole('admin');
    }
    
    public function update(User $user, Category $category)
    {
        // Only admin users can update categories
        return $user->hasRole('admin');
    }
    
    public function delete(User $user, Category $category)
    {
        // Only admin users can delete categories
        return $user->hasRole('admin');
    }
}

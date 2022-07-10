<?php

namespace App\Http\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class UserComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * Create a new profile composer.
     *
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user_count', $this->userRepository->count());
    }
}

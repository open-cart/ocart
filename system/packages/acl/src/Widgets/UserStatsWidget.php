<?php
namespace Ocart\Acl\Widgets;

use Ocart\Acl\Repositories\UserRepository;
use Ocart\Dashboard\Supports\StatsWidget;

class UserStatsWidget extends StatsWidget
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function buildWidget()
    {
        $this->setTotal($this->userRepository->count());
    }
}
<?php
declare(strict_types=1);

namespace Vendor\AdminTimezone\Plugin;

use Magento\Framework\App\State;
use Magento\Framework\Stdlib\DateTime\Timezone;
use Magento\Backend\Model\Auth\Session;

class AdminTimezone
{
    public function __construct(
        private readonly State $appState,
        private readonly Session $adminSession,
    ) {}

    public function afterGetConfigTimezone(Timezone $subject, string $result): string
    {
        try {
            if ($this->appState->getAreaCode() !== \Magento\Framework\App\Area::AREA_ADMINHTML)
                return $result;
        } catch (\Exception) {
            return $result;
        }

        $user = $this->adminSession->getUser();
        $userTimezone = $user?->getData('timezone');

        return $userTimezone ?: $result;
    }
}

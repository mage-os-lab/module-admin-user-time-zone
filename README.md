# MageOS Admin User Time Zone Module for Magento 2

Per-user timezone support for Magento 2 admin panel

---

## Overview

The **Admin User Time Zone** module allows each admin user to have a personal timezone that overrides the store's global timezone when working in the admin panel. Dates and times displayed in the backend will reflect the individual user's timezone instead of the system default.

## Features

- Adds a `timezone` column to the `admin_user` table via a Data Patch
- Intercepts `Magento\Framework\Stdlib\DateTime\Timezone::getConfigTimezone` in the `adminhtml` area and replaces the result with the user's personal timezone when set
- Falls back transparently to the store's configured timezone if no personal timezone is defined for the user

## Installation

1. Install into your Mage-OS/Magento 2 project with composer:
    ```
    composer require mage-os/module-admin-user-time-zone
    ```
2. Enable the module:
    ```
    bin/magento setup:upgrade
    ```

## Configuration

The module works automatically once installed. No store configuration is required.

Each admin user's timezone is stored in the `timezone` column of the `admin_user` table (`64 char`, nullable). When populated, the value overrides the global store timezone exclusively within the `adminhtml` area.

To assign a timezone to an admin user, navigate to ___System > All Users___, open the desired user and set the **Timezone** field. Use any valid PHP timezone identifier (e.g. `Europe/Rome`, `America/New_York`). If left empty, the store's global timezone is used as fallback.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

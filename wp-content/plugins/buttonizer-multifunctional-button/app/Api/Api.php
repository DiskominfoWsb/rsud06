<?php
/*
 * SOFTWARE LICENSE INFORMATION
 *
 * Copyright (c) 2017 Buttonizer, all rights reserved.
 *
 * This file is part of Buttonizer
 *
 * For detailed information regarding to the licensing of
 * this software, please review the license.txt or visit:
 * https://buttonizer.pro/license/
 */

namespace Buttonizer\Api;

class Api
{
    /**
     * Register 3.0 API endpoints
     */
    public function __construct()
    {
        // Site synchronization
        (new Connection\Sync())->registerRoute();
        (new Connection\Disconnect())->registerRoute();
        (new Connection\Connect())->registerRoute();

        // Plugin settings
        (new Settings\UpdateSettings())->registerRoute();

        // Editor
        (new Connection\StartEditorSession())->registerRoute();

        // Analytics
        (new Analytics\Overview())->registerRoute();

        // Legacy
        (new Utils\DeleteLegacyBackup())->registerRoute();
        (new Utils\RevertToLegacy())->registerRoute();
    }

    /**
     * Return error, need Buttonizer pro
     */
    public static function needButtonizerPremium()
    {
        return new \WP_Error('missing_premium_license', 'You do not have Buttonizer Pro.', [
            'status' => 403
        ]);
    }
}

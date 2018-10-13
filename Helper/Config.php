<?php

namespace Magteric\CloudflareCache\Helper;

use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLED = 'magteric_cloudflare_cache/general/active';
    const XML_PATH_API_EMAIL = 'magteric_cloudflare_cache/general/email';
    const XML_PATH_API_KEY = 'magteric_cloudflare_cache/general/api_key';

    /**
     * Is the module enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    /**
     * Email address associated with Cloudflare account
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_EMAIL, ScopeInterface::SCOPE_STORE);
    }

    /**
     * API key address associated with Cloudflare account
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_KEY, ScopeInterface::SCOPE_STORE);
    }
}

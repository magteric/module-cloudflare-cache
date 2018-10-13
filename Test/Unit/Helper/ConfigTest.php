<?php

namespace Magteric\CloudflareCache\Test\Unit\Helper;

use Magento\Store\Model\ScopeInterface;
use Magteric\CloudflareCache\Helper\Config as ConfigHelper;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $context;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $scopeConfigMock;

    /** @var ConfigHelper */
    protected $configHelper;

    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->context = $this->createPartialMock(\Magento\Framework\App\Helper\Context::class, ['getScopeConfig']);

        $this->scopeConfigMock = $this->createMock(\Magento\Framework\App\Config\ScopeConfigInterface::class);
        $this->context->expects($this->once())->method('getScopeConfig')->willReturn($this->scopeConfigMock);

        $this->configHelper = $objectManager->getObject(ConfigHelper::class, [
            'context' => $this->context
        ]);
    }

    public function testIsEnabled()
    {
        $expectedValue = true;

        $this->scopeConfigMock->expects($this->once())
            ->method('isSetFlag')
            ->with(ConfigHelper::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->configHelper->isEnabled());
    }

    public function testGetEmail()
    {
        $expectedValue = 'test@example.com';

        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(ConfigHelper::XML_PATH_API_EMAIL, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->configHelper->getEmail());
    }

    public function testGetApiKey()
    {
        $expectedValue = '1234567890';

        $this->scopeConfigMock->expects($this->once())
            ->method('getValue')
            ->with(ConfigHelper::XML_PATH_API_KEY, ScopeInterface::SCOPE_STORE)
            ->willReturn($expectedValue);

        $this->assertEquals($expectedValue, $this->configHelper->getApiKey());
    }
}

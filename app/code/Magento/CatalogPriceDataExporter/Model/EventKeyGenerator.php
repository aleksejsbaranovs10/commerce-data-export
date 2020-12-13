<?php

declare(strict_types=1);

namespace Magento\CatalogPriceDataExporter\Model;

/**
 * Class responsible for generation and resolving events array key
 */
class EventKeyGenerator
{
    /**
     * Elements used for events array key generation
     */
    private const KEY_ELEMENTS = ['event_type', 'website_id', 'customer_group_id'];

    /**
     * Separator for elements, used for array key generation and resolution.
     */
    private const SEPARATOR = '/';

    /**
     * Generate array key.
     *
     * @param string $eventType
     * @param string $websiteId
     * @param string|null $customerGroupId
     *
     * @return string
     */
    public function generate(string $eventType, string $websiteId, ?string $customerGroupId): string
    {
        return \base64_encode(\implode(self::SEPARATOR, [$eventType, $websiteId, $customerGroupId]));
    }

    /**
     * Resolve array key.
     *
     * @param string $key
     *
     * @return array
     */
    public function resolveKey(string $key): array
    {
        return \array_combine(self::KEY_ELEMENTS, \explode(self::SEPARATOR, \base64_decode($key)));
    }
}
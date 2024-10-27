<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PublicAPIsService
{
    protected const BASE_URL = 'https://web.archive.org/web/20240403172734if_/https://api.publicapis.org/';

    protected const ENTRIES_JSON_FILE_PATH = 'entries.json';

    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => self::BASE_URL
        ]);
    }

    /**
     * Get entries from the API.
     * If the request fails, get the entries from a JSON file.
     *
     * @param array $categories The categories to filter the entries by.
     * @param bool $forceUseJsonFile Whether to force the use of the JSON file.
     * @return array
     */
    public function getEntries(array $categories = [], bool $forceUseJsonFile = false): array
    {
        if ($forceUseJsonFile === false) {
            try {
                $response = $this->request('entries');
            } catch (RequestException|Exception $e) {
                $response = $this->getEntriesFromJsonFile();
            }
        } else {
            $response = $this->getEntriesFromJsonFile();
        }

        $arrayResponse = json_decode($response, true) ?? [];
        $entries = data_get($arrayResponse, 'entries', []);

        return $categories
            ? $this->filterEntriesByCategory($entries, $categories)
            : $entries;
    }

    /**
     * Make an HTTP request
     *
     * @param string $uri
     * @return string|null
     */
    protected function request(string $uri, string $method = 'GET', array $options = []): ?string
    {
        $response = retry(3, fn () => $this->httpClient->request($method, $uri, $options), 1000);

        return $response->getBody()
            ? $response->getBody()->getContents()
            : null;
    }

    /**
     * Get entries from a JSON file.
     *
     * @return string
     */
    protected function getEntriesFromJsonFile(): string
    {
        $path = storage_path(self::ENTRIES_JSON_FILE_PATH);

        return file_get_contents($path);
    }

    /**
     * Filter entries by category.
     *
     * @param array $entries
     * @param array $categories
     * @return array
     */
    protected function filterEntriesByCategory(array $entries, array $categories): array
    {
        return array_values(
            array_filter(
                $entries,
                fn ($entry) => in_array($entry['Category'], $categories)
            )
        );
    }
}

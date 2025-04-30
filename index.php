<?php

class MetaExtractor
{
    private string $html;
    private array $meta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

    public function __construct(string $html)
    {
        $this->html = $html;
    }

    public function extract(): array
    {
        $this->extractTitle();
        $this->extractMetaTags();
        return $this->meta;
    }

    private function extractTitle(): void
    {
        if (preg_match('/<title>(.*?)<\/title>/si', $this->html, $matches)) {
            $this->meta['title'] = trim($matches[1]);
        }
    }

    private function extractMetaTags(): void
    {
        if (preg_match_all('/<meta[^>]+>/i', $this->html, $allMetaTags)) {
            foreach ($allMetaTags[0] as $tag) {
                if (stripos($tag, 'name="description"') !== false || stripos($tag, "name='description'") !== false) {
                    if (preg_match('/content=["\'](.*?)["\']/i', $tag, $match)) {
                        $this->meta['description'] = trim($match[1]);
                    }
                }
                if (stripos($tag, 'name="keywords"') !== false || stripos($tag, "name='keywords'") !== false) {
                    if (preg_match('/content=["\'](.*?)["\']/i', $tag, $match)) {
                        $this->meta['keywords'] = trim($match[1]);
                    }
                }
            }
        }
    }
}


$html = file_get_contents('file.html');
$extractor = new MetaExtractor($html);
$result = $extractor->extract();

echo "Title: {$result['title']}\n";
echo "Description: {$result['description']}\n";
echo "Keywords: {$result['keywords']}\n";

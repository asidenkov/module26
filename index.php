<?php

class MetaExtractor implements Iterator
{
    private string $html;
    private array $meta = [
        'title' => '',
        'description' => '',
        'keywords' => ''
    ];

    private int $position = 0;
    private array $keys = [];

    public function __construct(string $html)
    {
        $this->html = $html;
        $this->extract();
        $this->keys = array_keys($this->meta);
    }

    private function extract(): void
    {
        $this->extractTitle();
        $this->extractMetaTags();
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

    

    public function current(): mixed
    {
        return $this->meta[$this->keys[$this->position]];
    }

    public function key(): mixed
    {
        return $this->keys[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->keys[$this->position]);
    }
}


$html = file_get_contents('file.html');
$extractor = new MetaExtractor($html);

foreach ($extractor as $key => $value) {
    echo ucfirst($key) . ": $value<br>";
}

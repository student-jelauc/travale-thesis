<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class Select2Builder
{
    /**
     * @var Model
     */
    private $query;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array<string, string>
     */
    private $select = ['id', 'name'];

    /**
     * @var null|string
     */
    private $groupBy = null;

    /**
     * @var string
     */
    private $order = ['name', 'asc'];

    /**
     * @var int
     */
    private $pageLength = 15;

    /**
     * Select2Builder constructor.
     *
     * @param Builder $query
     */
    public function __construct($query)
    {
        $this->query = $query;
        $this->request = request();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return response()->json($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->filterValues();
        $this->filterTerm();
        $this->pagination();

        $results =  $this->query->orderBy(...$this->order)->get();

        return [
            'results' => $this->groupBy
                ? $this->makeGroupedResult($results)
                : $results->map(function ($item) { return $this->wrapOption($item); }),
            'more' => $results->count() === $this->pageLength,
        ];
    }

    /**
     * @param string $id
     * @param string $text
     * @return Select2Builder
     */
    public function setSelectColumns(string $text, string $id = 'id')
    {
        $this->select = [$id, $text];

        return $this;
    }

    /**
     * @param string $column
     * @param string $dir
     *
     * @return Select2Builder
     */
    public function setOrder(...$orderBy)
    {
        $this->order = $orderBy;

        return $this;
    }

    /**
     * @param string|callable $grouper
     * @return $this
     */
    public function setGroupBy($grouper)
    {
        $this->groupBy = $grouper;

        return $this;
    }

    /**
     * @param int $pageLength
     * @return Select2Builder
     */
    public function setPageLength(int $pageLength)
    {
        $this->pageLength = $pageLength;

        return $this;
    }

    /**
     * Filter for already selected values
     */
    protected function filterValues()
    {
        if (! $this->request->value) {
            return;
        }

        $this->query->whereIn($this->select[0], Arr::wrap($this->request->value));
    }

    /**
     * Filter for already selected values
     */
    protected function filterTerm()
    {
        if (! $this->request->term) {
            return;
        }

        $this->query->where($this->select[1], 'ilike', "%{$this->request->term}%");
    }

    /**
     * Set current page & page limit
     */
    protected function pagination()
    {
        $this->pageLength = $this->request->has('limit') ? $this->request->limit : $this->pageLength;
        $page = $this->request->page ?? 1;
        $page -= 1;

        $this->query->limit($this->pageLength);
        $this->query->offset($page * $this->pageLength);
    }

    /**
     * @param Collection $items
     * @return Collection|\Illuminate\Support\Collection
     */
    protected function makeGroupedResult($items)
    {
        $groupBy = $this->groupBy;
        $grouper = function ($item) use ($groupBy) {
            return is_callable($groupBy) ? $groupBy($item) : Arr::get($item, $groupBy);
        };

        return array_values(
            $items->reduce(function (&$carry, $item) use ($grouper) {
                $group = $grouper($item);
                if (!isset($carry[$group])) {
                    $carry[$group] = ['text' => $group, 'children' => [$this->wrapOption($item)]];
                } else {
                    $carry[$group]['children'][] = $this->wrapOption($item);
                }

                return $carry;
            }, [])
        );
    }

    /**
     * @param $item
     * @return array
     */
    protected function wrapOption($item)
    {
        return [
            'id' => $item->{$this->select[0]},
            'text' => $item->{$this->select[1]},
        ];
    }
}

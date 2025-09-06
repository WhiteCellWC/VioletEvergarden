<?php

namespace Modules\Shared\DTO;

use App\Enums\OrderType;

readonly class QueryOptionsDto
{
    public const orderBy = 'orderBy';

    public const orderType = 'orderType';

    public const offset = 'offset';

    public const limit = 'limit';

    public const noPagination = 'noPagination';

    public const pagPerPage = 'pagPerPage';

    public function __construct(
        public ?string $orderBy,
        public ?OrderType $orderType,
        public ?int $offset,
        public ?int $limit,
        public ?bool $noPagination,
        public ?int $pagPerPage,
    ) {}

    public function toArray()
    {
        return [
            self::orderBy => $this->orderBy,
            self::orderType => $this->orderType,
            self::offset => $this->offset,
            self::limit => $this->limit,
            self::noPagination => $this->noPagination,
            self::pagPerPage => $this->pagPerPage
        ];
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->order_by,
            $request->order_type,
            $request->offset,
            $request->limit,
            $request->no_pagination,
            $request->pag_per_page,
        );
    }
}

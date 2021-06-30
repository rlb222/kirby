<?php

use Kirby\Toolkit\Pagination;

return [
    'props' => [
        /**
         * Sets the number of items per page. If there are more items the pagination navigation will be shown at the bottom of the section.
         */
        'limit' => function (int $limit = 20) {
            return $limit;
        },
    ],
    'computed' => [
        'page' => function () {
            $session = $this->kirby()->session();
            $id      = $this->model()->panel()->url(true) . '/' . $this->name;

            if ($page = (get($this->name)['page'] ?? null)) {
                $session->set($id . '[page]', $page);
            } else {
                $page = $session->get($id . '[page]', 1);
            }

            return $page;
        },
    ],
    'methods' => [
        'pagination' => function () {
            $pagination = new Pagination([
                'limit' => $this->limit,
                'page'  => $this->page,
                'total' => $this->total
            ]);

            return [
                'limit'  => $pagination->limit(),
                'offset' => $pagination->offset(),
                'page'   => $pagination->page(),
                'total'  => $pagination->total(),
            ];
        },
    ]
];

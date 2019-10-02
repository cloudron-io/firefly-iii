<?php
/**
 * TransactionCurrencies.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace FireflyIII\Import\Mapper;

use FireflyIII\Repositories\Currency\CurrencyRepositoryInterface;

/**
 * Class TransactionCurrencies.
 */
class TransactionCurrencies implements MapperInterface
{
    /**
     * Get map of currencies.
     *
     * @return array
     */
    public function getMap(): array
    {
        /** @var CurrencyRepositoryInterface $repository */
        $repository = app(CurrencyRepositoryInterface::class);
        $currencies = $repository->get();
        $list       = [];
        foreach ($currencies as $currency) {
            $currencyId        = (int)$currency->id;
            $list[$currencyId] = $currency->name . ' (' . $currency->code . ')';
        }
        asort($list);

        $list = [0 => (string)trans('import.map_do_not_map')] + $list;

        return $list;
    }
}

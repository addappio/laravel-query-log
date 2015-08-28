<?php

namespace Addapp\QueryLog;

use Illuminate\Support\ServiceProvider;
use Event;
use Log;
use DateTime;


class QueryLogServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $countQueries = 0;
        Event::listen('illuminate.query', function ($query, $bindings) use (&$countQueries) {

            $bindings = $this->formatBindingsForSqlInjection($bindings);
            $query    = $this->insertBindingsIntoQuery($query, $bindings);

            $countQueries++;
            Log::info("--- Query $countQueries --- ".$query);
        });
    }

    /**
     * @param $bindings
     *
     * @return mixed
     */
    private function formatBindingsForSqlInjection($bindings)
    {
        foreach ($bindings as $i => $binding) {
            if ($binding instanceof DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } else {
                if (is_string($binding)) {
                    $bindings[$i] = "'$binding'";
                }
            }
        }

        return $bindings;
    }

    /**
     * @param $query
     * @param $bindings
     *
     * @return string
     */
    private function insertBindingsIntoQuery($query, $bindings)
    {
        if (empty($bindings)) {
            return $query;
        }
        
        $query = str_replace(array('%', '?'), array('%%', '%s'), $query);

        return vsprintf($query, $bindings);
    }
}

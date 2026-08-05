<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

trait FiltersResults
{
    protected function authorizeResults(): void
    {
        abort_if(auth()->user()->profile === 'patient', 403);
    }

    protected function filterResults(Builder $query, Request $request, array $searchColumns = ['name', 'ocupation', 'ocupacion', 'company']): Builder
    {
        $user = auth()->user();
        $table = $query->getModel()->getTable();
        $searchColumns = array_values(array_filter($searchColumns, fn ($column) => Schema::hasColumn($table, $column)));
        $allowedAll = in_array($user->profile, ['admin', 'administrator', 'administrador', 'psychologist', 'psicologo', 'supervisor']);
        $date = $request->input('date', now()->toDateString());
        $search = trim((string) $request->input('search', ''));

        return $query
            ->when(! $allowedAll && $user->place, fn ($query) => $query->where('place_id', $user->place))
            ->when($date, fn ($query) => $query->whereDate('created_at', $date))
            ->when($search !== '', function ($query) use ($search, $searchColumns) {
                $query->where(function ($query) use ($search, $searchColumns) {
                    foreach ($searchColumns as $column) {
                        $query->orWhere($column, 'like', "%{$search}%");
                    }

                    $query->orWhereHas('patient', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                });
            });
    }
}

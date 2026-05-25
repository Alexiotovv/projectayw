<?php

namespace App\Http\Controllers;

use App\Models\ServicePlan;
use Illuminate\Support\Str;

class PublicServiceController extends Controller
{
    public function index()
    {
        $plans = ServicePlan::query()
            ->where('is_active', true)
            ->orderBy('type')
            ->orderBy('price')
            ->get();

        $currentType = null;
        $currentTypeLabel = 'Todos los servicios';

        return view('public.services.index', compact('plans', 'currentType', 'currentTypeLabel'));
    }

    public function show(string $typeSlug)
    {
        $type = Str::of($typeSlug)->lower()->value();

        $plans = ServicePlan::query()
            ->where('is_active', true)
            ->where('type', $type)
            ->orderBy('price')
            ->get();

        abort_if($plans->isEmpty(), 404);

        $currentType = $type;
        $currentTypeLabel = Str::headline(str_replace('-', ' ', $type));

        return view('public.services.index', compact('plans', 'currentType', 'currentTypeLabel'));
    }
}

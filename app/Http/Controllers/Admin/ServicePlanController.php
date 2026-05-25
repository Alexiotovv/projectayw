<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ServicePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin']);
    }

    public function index()
    {
        $plans = ServicePlan::orderByDesc('created_at')->paginate(15);
        return view('admin.service-plans.index', compact('plans'));
    }

    public function create()
    {
        $types = $this->availableTypes();
        return view('admin.service-plans.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'type_custom' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => ['required', 'in:monthly,yearly'],
            'features' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $type = $this->resolveType($validated['type'] ?? null, $validated['type_custom'] ?? null);

        ServicePlan::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::lower(Str::random(4)),
            'type' => $type,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'billing_cycle' => $validated['billing_cycle'],
            'features' => $this->parseFeatures($validated['features'] ?? null),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.service-plans.index')->with('success', 'Plan de servicio creado correctamente.');
    }

    public function edit(ServicePlan $servicePlan)
    {
        $types = $this->availableTypes();
        return view('admin.service-plans.edit', compact('servicePlan', 'types'));
    }

    public function update(Request $request, ServicePlan $servicePlan)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'type_custom' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_cycle' => ['required', 'in:monthly,yearly'],
            'features' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $type = $this->resolveType($validated['type'] ?? null, $validated['type_custom'] ?? null);

        $servicePlan->update([
            'name' => $validated['name'],
            'type' => $type,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'billing_cycle' => $validated['billing_cycle'],
            'features' => $this->parseFeatures($validated['features'] ?? null),
            'is_active' => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.service-plans.index')->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy(ServicePlan $servicePlan)
    {
        $servicePlan->delete();
        return redirect()->route('admin.service-plans.index')->with('success', 'Plan eliminado correctamente.');
    }

    private function parseFeatures(?string $raw): array
    {
        if (!$raw) {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $raw);
        $features = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line !== '') {
                $features[] = $line;
            }
        }

        return $features;
    }

    private function availableTypes(): Collection
    {
        return ServicePlan::query()
            ->whereNotNull('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type')
            ->values();
    }

    private function resolveType(?string $selectedType, ?string $customType): string
    {
        $candidate = $selectedType;
        if ($selectedType === '__new__') {
            $candidate = $customType;
        }

        $type = Str::slug((string) $candidate);
        if ($type === '') {
            throw ValidationException::withMessages([
                'type' => 'Debes seleccionar o escribir un tipo de servicio válido.',
            ]);
        }

        return $type;
    }
}

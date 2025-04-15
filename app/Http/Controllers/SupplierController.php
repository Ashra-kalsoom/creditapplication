<?php
// app/Http/Controllers/SupplierController.php
namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protect all admin routes
    }

    /**
     * Display a listing of the suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('name')->paginate(15);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created supplier in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers',
            'template_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'boolean',
            'field_mappings' => 'nullable|array',
        ]);

        Supplier::create([
            'name' => $request->name,
            'template_name' => $request->template_name,
            'description' => $request->description,
            'active' => $request->boolean('active', true),
            'field_mappings' => $request->field_mappings ?? [],
        ]);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier created successfully');
    }

    /**
     * Show the form for editing the specified supplier.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified supplier in storage.
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name,' . $id,
            'template_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'boolean',
            'field_mappings' => 'nullable|array',
        ]);

        $supplier->update([
            'name' => $request->name,
            'template_name' => $request->template_name,
            'description' => $request->description,
            'active' => $request->boolean('active', true),
            'field_mappings' => $request->field_mappings ?? [],
        ]);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier updated successfully');
    }

    /**
     * Remove the specified supplier from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Check if there are any applications using this supplier
        $hasApplications = $supplier->creditApplications()->exists();

        if ($hasApplications) {
            return back()->withErrors(['error' => 'Cannot delete supplier with existing applications']);
        }

        $supplier->delete();

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Supplier deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Panel;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ServiceRequest;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        return view('panel.services.index')->with([
            'services' => Service::all(),
        ]);
    }

    public function create()
    {
        return view('panel.services.create');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'min:1'],
            'capacity' => ['required', 'min:1'],
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 400,
                'errors'=>$validator->errors()
            ]);
        } 
        else
        {
            return response()->json([
                'status'=> 200,
                'message'=>'Servicio validado'
            ]);
        }
    }

    public function store(Request $request)
    {
        $service = Service::create($request->all());

        if($request->hasFile('image')) {
            $service->image()->create([
                'path' => 'images/' . $request->image->store('services', 'images'),
            ]);
        }
        
        return redirect()
            ->route('services.index')
            ->withSuccess("El servicio se ha agregado exitosamente");
    }
    
    public function show(Service $service)
    {
        return view('panel.services.single')
            ->with([
                'service' => $service
            ]);
    }
    
    public function edit(Service $service)
    {
        return view('panel.services.edit')
            ->with([
                'service' => $service
            ]);
    }
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());

        if ($request->hasFile('image')) {

            $path = storage_path("app/public/{$service->image->path}");
    
            File::delete($path); 
            
            $service->image->delete();
    
            $service->image()->create([
                'path' => 'images/' . $request->image->store('services', 'images')
            ]);
        }
        return redirect()
            ->route('services.index')
            ->withSuccess("El servicio con id {$service->id} ha sido editado.");
    }
    public function destroy(Service $service)
    {
        $service->bookingOrders()->detach();
        $service->bookings()->detach();
        // $service->bookings()->delete();

        $service->delete();

        return redirect()
            ->route('services.index')
            ->withSuccess("El servicio con id {$service->id} ha sido eliminado");
    }

}

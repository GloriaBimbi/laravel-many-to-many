<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $types = Type::paginate(5);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $type = new Type;
        return view('admin.types.form', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $type = new Type;
        $type->fill($data);
        $type->save();


        return redirect()->route('admin.types.show', $type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {
        //per la paginazione della tabella dei progetti collegati ai singoli type
        $related_projects = $type->projects()->paginate(5);

        return view('admin.types.show', compact('type', 'related_projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        return view('admin.types.form', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->all();
        $type->fill($data);
        $type->save();

        return redirect()->route('admin.types.show', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function destroy(Request $request, Type $type)
    {
        //recupero il valore dell'attributo delete-action inviato dal form della model della index dei type per capire se lo user vuole cancellare i projects (delete) o associarli ad un altro type
        $action = $request->input('delete-action');

        if ($action === 'delete'){
            //alla cancellazione del type cancello tutti i postad essa associati
            foreach($type->projects as $project){
                $project->delete();
            }
        } else {
            // altrimenti associamo ogni post della categoria cancellata al type scelto dallo user con la select sulla model nella index dei types
            foreach($type->projects as $project){
                $project->type_id = $action;
                $project->save();
            }
        }
        
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}

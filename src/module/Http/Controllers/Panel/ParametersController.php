<?php
/**
 * Created by PhpStorm.
 * User: anderson
 * Date: 20/06/16
 * Time: 19:32
 */

namespace Andersonef\AvalonAdmin\Http\Controllers\Panel;


use Andersonef\AvalonAdmin\Facades\Parameter;
use Andersonef\AvalonAdmin\Http\Requests\ParameterRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ParametersController extends Controller
{

    public function index()
    {
        return view('AvalonAdmin::content.panel.parameters.index');
    }

    public function create()
    {
        return view('AvalonAdmin::content.panel.parameters.create');
    }

    public function edit($id)
    {
        $parameter = Parameter::find($id);
        if(!$parameter)
            return abort(404);
        return view('AvalonAdmin::content.panel.parameters.edit', ['parameter' => $parameter]);
    }


    public function store(ParameterRequest $request)
    {
        try{
            Parameter::create($request->only(['id', 'parameterDescription', 'parameterValue']));
            return redirect()->route('avalon.admin.panel.parameters.index')->with(['success' => trans('AvalonAdmin::Module/Controllers/Parameters.store.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try{
            Parameter::destroy($id);
            return redirect()->route('avalon.admin.panel.parameters.index')->with(['success' => trans('AvalonAdmin::Module/Controllers/Parameters.destroy.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }


    public function update($id, ParameterRequest $request)
    {
        try{
            Parameter::update($id, $request->only(['id', 'parameterDescription', 'parameterValue']));
            return redirect()->route('avalon.admin.panel.parameters.index')->with(['success' => trans('AvalonAdmin::Module/Controllers/Parameters.update.success')]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
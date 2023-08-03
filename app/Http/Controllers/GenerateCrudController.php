<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GenerateCrudController extends Controller
{

    public function generateCrudView()
    {

        $db_types = [
            'string',
            'char',
            'text',
            'integer',
            'bigInteger',
            'float',
            'double',
            'decimal',
            'boolean',
            'date',
            'datetime',
            'time',
            'timestamp',
            // Add more column types as needed
        ];
        $html_types = [
            'text',
            'password',
            'email',
            'number',
            'date',
            'checkbox',
            'radio',
            'file',
            'hidden',
            // Add more input types as needed
        ];
        return view('backend.generate-crud.create', compact('db_types', 'html_types'));
    }



    public function generateCrudCommand(Request $request)
    {
        $request->validate([
            'model_name' => 'required',

        ]);

        // return response($request->all());
        // dd($request->all());

        // $modelName = 'CrudFromCntr';
        // $fields = 'name:string:text:true:false,email:string:email:true:true,phone:integer:number:false:true,country:string:text:true:false';
        $fields = '';
        $view = '';
        $required = '';
        if (strpos($request->model_name, ' ') !== false) {
            $parts = explode(' ', $request->model_name);

            $capitalizedParts = array_map(function ($part) {
                return Str::singular(ucfirst($part));
            }, $parts);

            // Join the capitalized parts back together with an underscore
            $modelName = implode('_', $capitalizedParts);
        } else {
            $modelName = $request->model_name;
        }
        // dd($modelName);

        if (count($request->fields)) {
            $fieldsArray = [];

            foreach ($request->fields as $field) {

                if ($field['name'] == '') {
                    return redirect()->back()->with('error', 'The Field  name cannot be empty!');
                } elseif ($field['types']['db_type'] == '') {
                    return redirect()->back()->with('error', 'The db_type field cannot be empty!');
                } elseif ($field['types']['html_type'] == '') {
                    return redirect()->back()->with('error', 'The html_type field cannot be empty!');
                }

                if (isset($field['types']['view_show'])) {
                    $view = 'true';
                } else {
                    $view = 'false';
                }
                if (isset($field['types']['validation'])) {
                    $required = 'true';
                } else {
                    $required = 'false';
                }

                if (strpos($field['name'], ' ') !== false) {
                    $field_name = str_replace(' ', '_', $field['name']);
                    $field_name = strtolower($field_name);
                } else {
                    $field_name = strtolower($field['name']);
                }

                $fieldInfo = $field_name . ':' . $field['types']['db_type'] . ':' . $field['types']['html_type'] . ':' . $view  . ':' . str_replace(':', '(}', $field['types']['validation']);
                $fieldsArray[] = $fieldInfo;
            }

            $fields = implode(',', $fieldsArray);
        } else {
            return redirect()->back()->with('error', 'Atleast one field should be added for the model!');
        }
        // return response()->json($fields);


        // Generate the command string with dynamic data
        $command = 'generate:crud ' . $modelName . ' --fields="' . $fields . '"';
        // return response()->json(stripslashes($command);
        // dd($command);
        // Call the Artisan command
        Artisan::call($command);

        return view('backend.generate-crud.success');
        // Get the output (if needed)
        $output = Artisan::output();

        // Return any response as needed
        return response()->json(['message' => 'CRUD generated successfully', 'output' => $output]);
    }


    public function run_migration()
    {
        Artisan::call('migrate');
        return redirect()->route('admin.dashboard');
    }
}

@extends('layouts.backend.main')

@section('admin-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title text-center">Create Crud Form</h1>
                </div>
                <div class="card-body">

                    @include('partials.backend.messages')
                    <form action="{{ route('admin.generate_crud.submit') }}" method="post">
                        @csrf

                        <!-- Model Name -->
                        <div class="form-group">
                            <label for="model_name">Table Name:</label>
                            <input type="text" name="model_name" id="model_name"
                                class="form-control @error('model_name') is-invalid @enderror " required>

                            @error('model_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fields Section -->
                        <div id="fields_section" class="shadow">
                            <div class="field_wrapper border-1 border-light shadow-sm p-3 mb-3">
                                <div class="form-group">
                                    <label for="field_name">Field Name:</label>
                                    <input type="text" name="fields[0][name]" class="form-control field_name" required>
                                </div>

                                <fieldset>
                                    <legend>Subfields</legend>
                                    <div class="subfield_wrapper">
                                        <div class="subfield">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>DB TYPE:</label>
                                                        <select name="fields[0][types][db_type]" id="column_type"
                                                            class="form-control" required>
                                                            {{-- <option value="">Select db column type</option> --}}
                                                            @foreach ($db_types as $type)
                                                                <option value="{{ $type }}">{{ $type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>HTML Type:</label>
                                                        <select name="fields[0][types][html_type]" id="html_input_type"
                                                            class="form-control" required>
                                                            {{-- <option value="">Select html input type</option> --}}
                                                            @foreach ($html_types as $type)
                                                                <option value="{{ $type }}">{{ $type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group" style="">
                                                        <label class="text-center">Validation: </label>
                                                        <input type="text" name="fields[0][types][validation]"
                                                            class="form-control subfield_validation " placeholder="required | max:3 etc... ">

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group" style="text-align: -webkit-center;">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="text-center" for="view_checkbox"> View Page:</label>
                                                                <input type="checkbox" name="fields[0][types][view_show]"
                                                                    class="form-check subfield_required mt-3" id="view_checkbox">
                                                            </div>
                                                            {{-- <div class="col">
                                                                <label class="text-center">Required: </label>
                                                                <input type="checkbox" name="fields[0][types][required]"
                                                                    class="form-check subfield_required mt-3">
                                                            </div> --}}
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <button type="button" class="add_subfield">Add Subfield</button> --}}
                                </fieldset>
                                <button type="button" class="btn btn-danger remove_field">Remove Field</button>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" id="add_field">Add Field</button>
                        {{-- <button type="button" class="btn btn-primary" id="add_foregnId">Add ForeginId</button> --}}
                        <button type="submit" class="btn btn-success">Generate Crud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let fieldCount = 1;

            // Add new field with subfields
            $("#add_field").click(function() {
                let newField = `
                    <div class="field_wrapper border-1 border-light shadow p-3 mb-3">
                        <label for="field_name">Field Name:</label>
                        <input type="text" name="fields[${fieldCount}][name]" class="form-control field_name" required>

                        <fieldset>
                            <legend>Subfields</legend>
                            <div class="subfield_wrapper">
                                <div class="subfield">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>DB TYPE:</label>
                                                        <select name="fields[${fieldCount}][types][db_type]" id="column_type" class="form-control" required>
                                                            {{--  <option value="">Select db column type</option> --}}
                                                            @foreach ($db_types as $type)
                                                                <option value="{{ $type }}">{{ $type }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>HTML Type:</label>
                                                        <select name="fields[${fieldCount}][types][html_type]" id="html_input_type" class="form-control" required>
                                                            {{-- <option value="">Select html input type</option> --}}
                                                            @foreach ($html_types as $type)
                                                                <option value="{{ $type }}">{{ $type }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group" style="">
                                                        <label class="text-center">Validation: </label>
                                                        <input type="text" name="fields[${fieldCount}][types][validation]"
                                                            class="form-control subfield_validation " placeholder="required | max:3 etc... ">

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group" style="text-align: -webkit-center;">
                                                        <div class="row">
                                                            <div class="col">
                                                                <label class="text-center" >View Page:</label>
                                                                <input type="checkbox" name="fields[${fieldCount}][types][view_show]"
                                                                    class="form-check subfield_option mt-3">
                                                            </div>
                                                            {{-- <div class="col">
                                                                    <label class="text-center">Required:</label>
                                                                    <input type="checkbox" name="fields[${fieldCount}][types][required]"
                                                                    class="form-check subfield_required mt-3">
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                            </div>
                        </fieldset>
                        <button type="button" class="btn btn-danger remove_field">Remove Field</button>
                    </div>
                `;
                $("#fields_section").append(newField);
                fieldCount++;
            });

            // Add new subfield
            $(document).on("click", ".add_subfield", function() {
                let subfieldCount = $(this).siblings(".subfield_wrapper").children().length;
                let fieldIndex = $(this).closest(".field_wrapper").index();
                let newSubfield = `
                    <div class="subfield">
                        <label>Subfield Name:</label>
                        <input type="text" name="fields[${fieldIndex}][subfields][${subfieldCount}][name]" class="subfield_name" required>

                        <label>Type:</label>
                        <input type="text" name="fields[${fieldIndex}][subfields][${subfieldCount}][type]" class="subfield_type" required>

                        <label>Option:</label>
                        <input type="text" name="fields[${fieldIndex}][subfields][${subfieldCount}][option]" class="subfield_option">

                        <label>Required:</label>
                        <input type="checkbox" name="fields[${fieldIndex}][subfields][${subfieldCount}][required]">
                    </div>
                `;
                $(this).siblings(".subfield_wrapper").append(newSubfield);
            });




            // $('#add_foregnId').click(function(e){
            //     e.prevenDefault();

            //     let output = `<div class="field_wrapper border-1 border-light shadow-sm p-3 mb-3">
        //                     <div class="form-group">
        //                         <label for="field_name">Field Name:</label>
        //                         <input type="text" name="fields[0][name]" class="form-control field_name" required>
        //                     </div>

        //                     <fieldset>
        //                         <legend>Subfields</legend>
        //                         <div class="subfield_wrapper">
        //                             <div class="subfield">
        //                                 <div class="row">
        //                                     <div class="col d-none">
        //                                         <div class="form-group">
        //                                             <label>DB TYPE:</label>
        //                                             <select name="fields[0][types][foreginId]" id="column_type" class="form-control" required>
        //                                                 <option value="">Select db column type</option>
        //                                                 @foreach ($db_types as $type)
        //                                                     <option value="{{ $type }}">{{ $type }}</option>
        //                                                 @endforeach
        //                                             </select>
        //                                         </div>
        //                                     </div>
        //                                     <div class="col">
        //                                         <div class="form-group">
        //                                             <label>HTML Type:</label>
        //                                             <select name="fields[0][types][html_type]" id="html_input_type" class="form-control" required>
        //                                                 <option value="">Select html input type</option>
        //                                                 @foreach ($html_types as $type)
        //                                                     <option value="{{ $type }}">{{ $type }}</option>
        //                                                 @endforeach
        //                                             </select>
        //                                         </div>
        //                                     </div>
        //                                     <div class="col">
        //                                         <div class="form-group">
        //                                             <label class="text-center">Show Value On View Page:</label>
        //                                             <input type="checkbox" name="fields[0][types][view_show]"
        //                                                 class="form-control subfield_required">
        //                                         </div>
        //                                     </div>
        //                                     <div class="col">
        //                                         <div class="form-group">
        //                                             <label class="text-center">Required: <sup>(also used as nullable(true, false))</sup></label>
        //                                             <input type="checkbox" name="fields[0][types][required]"
        //                                                 class="form-control subfield_required">
        //                                         </div>
        //                                     </div>
        //                                 </div>

        //                             </div>
        //                         </div>
        //                         {{-- <button type="button" class="add_subfield">Add Subfield</button> --}}
        //                     </fieldset>
        //                     <button type="button" class="btn btn-danger remove_field">Remove Field</button>
        //                 </div>`;
            // })













            $(document).on("click", ".remove_field", function() {
                $(this).closest(".field_wrapper").remove();
            });


        });
    </script>
@endsection

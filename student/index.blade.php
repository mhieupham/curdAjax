@extends('layout')
@section('content')
    <h3>Database Server Side</h3>
    <div class="float-right">
        <button type="button" id="add_data" name='add' class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
            Add
        </button>
    </div>
    <table id="student_table" class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First_Name</th>
            <th scope="col">Last_Name</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody id="list-item">
        </tbody>

    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">

        </ul>
    </nav>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="student_form" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Add data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <span class="form-output"></span>
                        <div class="form-group">
                            <label class="">Enter first name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label class="">Enter last name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="student_id" id="student_id">
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add" name="submit" id="action" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

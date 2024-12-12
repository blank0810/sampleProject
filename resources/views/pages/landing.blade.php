@extends('general_layouts.body')
@section('title', 'To do List')
@section('pageSpecificStyle')
@stop

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2><i class="fas fas fa-file-alt mr-2"></i>To do list</h2>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-5">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Task Submission</h3>
              </div>
              <form action="/submit" method="post" id="submitForm" class="needs-validation" novalidate>
                <div class="card-body">
                  <div class="form-group">
                    <label>Task Title</label>
                    <input type="text" class="form-control" id="taskTitle" name="taskTitle" placeholder="Cleaning"
                      required>
                  </div>
                  <div class="form-group">
                    <label>Task Description</label>
                    <input type="text" class="form-control" id="taskDescription" name="taskDescription"
                      placeholder="I need to clean....." required>
                  </div>
                  <div class="form-group">
                    <label>Task Status</label>
                    <select class="form-control" id="statusSelect" name="statusSelect">
                      <option disabled selected>Choose Status</option>
                      <option value="Ongoing" class="text-primary">Ongoing</option>
                      <option value="Done" class="text-success">Done</option>
                      <option value="Cancelled" class="text-danger">Cancelled</option>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="button" id="submitBtn" class="btn btn-primary float-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-7">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-file mr-2"></i>
                  To Do List
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered" id="taskTable">
                  <thead>
                    <tr>
                      <td>Task ID</td>
                      <td>Task Title</td>
                      <td>Task Description</td>
                      <td>Status</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody id="taskList">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="updateModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Modify Task Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/update" method="post" id="updateForm" class="needs-validation" novalidate>
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" id="updateTaskId" style="display: none;">
                  </div>
                  <div class="form-group">
                    <label>Task Title</label>
                    <input type="text" class="form-control" id="updateTaskTitle" name="updateTaskTitle"
                      placeholder="Cleaning" required>
                  </div>
                  <div class="form-group">
                    <label>Task Description</label>
                    <input type="text" class="form-control" id="updateTaskDescription" name="updateTaskDescription"
                      placeholder="I need to clean....." required>
                  </div>
                  <div class="form-group">
                    <label>Task Status</label>
                    <select class="form-control" id="updateStatusSelect" name="updateStatusSelect">
                      <option disabled selected>Choose Status</option>
                      <option value="Ongoing" class="text-primary">Ongoing</option>
                      <option value="Done" class="text-success">Done</option>
                      <option value="Cancelled" class="text-danger">Cancelled</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" id="closeBtn" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="saveBtn" class="btn btn-primary">Save
                changes</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('pagespecificscript')

  <script>
    $(document).ready(function() {
      getTask();
      $('#submitBtn').on('click', function(e) {
        addTask();
      });

      $('#saveBtn').on('click', function(e) {
        Swal.fire({
          icon: 'question',
          title: 'Confirm modification',
          text: 'Do you wish to update this task?',
          showCancelButton: true,
          confirmButtonText: '<i class="far fa-check-circle"></i> Yes',
          cancelButtonText: '<i class="far fa-times-circle"></i> Cancel',
          confirmButtonColor: '#28a745', // Green color for the Yes button
          cancelButtonColor: '#dc3545', // Red color for the No button
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            editTask();
          }
        })
      })
    })

    $(document).on('click', '.delete-btn', function(event) {
      var row = $(this).closest('tr');
      var idCell = row.find('td[data-task-id]');
      var taskId = idCell.data('task-id');
      swal.fire({
        icon: 'question',
        title: 'Do you wish to delete this task?',
        html: '<span style="color: red;">Note: After deletion, the task cannot be recovered</span>',
        showCancelButton: true,
        confirmButtonText: '<i class="far fa-check-circle"></i> Yes',
        cancelButtonText: '<i class="far fa-times-circle"></i> Cancel',
        confirmButtonColor: '#28a745', // Green color for the Yes button
        cancelButtonColor: '#dc3545', // Red color for the No button
        reverseButtons: true,
      }).then((results) => {
        if (results.isConfirmed) {
          deleteTask(taskId);
        }
      })
    })

    $(document).on('click', '.edit-btn', function(event) {
      var taskModal = new bootstrap.Modal(document.getElementById('updateModal'));
      taskModal.show();
    })

    function getTask() {
      $.ajax({
        url: '/get-tasks',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            parseTask(response.data);
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Tasks loaded successfully!',
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true
            });
          } else {
            parseTask(response.data);
            Swal.fire({
              icon: 'warning',
              title: 'Empty Record',
              text: 'No record can be found on your account!',
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true
            });
          }
        },
        error: function(xhr) {
          console.log('Error fetching tasks: ' + xhr.responseText);
          Swal.fire({
            icon: 'error',
            title: 'Data Error',
            text: 'There is something wrong, please check the console!!',
            toast: true,
            showConfirmButton: false,
            position: 'top-end',
            timer: 1500,
            timerProgressBar: true
          });
        }
      });
    }

    function editTask() {
      var form = $('#updateForm');
      var formData = form.serialize();
      var taskId = $('#updateTaskId').val();
      $.ajax({
        url: `/update-task/${taskId}`,
        type: "POST",
        data: formData,
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true
            }).then((result) => {
              window.location.href = "/dashboard";
            });
          }
        },
        error: function(xhr) {
          console.log('An error occurred: ' + xhr.responseText);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred: Check the console log!!!',
          });
        }
      });
    }

    function addTask() {
      var form = $('#submitForm');
      var formData = form.serialize();
      console.log(formData);
      $.ajax({
        url: '/add-task',
        type: 'post',
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            swal.fire({
              icon: 'success',
              title: 'Task Created',
              text: response.message,
              toast: true,
              showConfirmButton: false,
              position: 'top-end',
              timer: 1500,
              timerProgressBar: false,
              showConfirmButton: false,
            });
            getTask();
          } else {
            swal.fire({
              icon: 'warning',
              title: 'Unknown error',
              text: response.message,
              toast: true,
              showConfirmButton: false,
              position: 'top-end',
              timer: 1500,
              timerProgressBar: false,
              showConfirmButton: false,
            });
          }
        }
      })
    }

    function deleteTask(taskId) {
      $.ajax({
        url: `/delete-task/${taskId}`,
        type: 'post',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.success) {
            getTask();
          } else {
            swal.fire({
              icon: 'warning',
              title: 'Unknown error',
              text: response.message,
              toast: true,
              showConfirmButton: false,
              position: 'top-end',
              timer: 1500,
              timerProgressBar: false,
              showConfirmButton: false,
            });
          }
        }
      })
    }

    function parseTask(tasks) {
      var taskTable = $('#taskList');
      taskTable.empty();

      $.each(tasks, function(index, task) {
        var row = $('<tr>');

        var title = task.task_title;
        var taskId = task.task_id;
        var desc = task.task_description;
        var status = task.task_status;

        $('#updateTaskId').val(taskId);
        $('#updateTaskTitle').val(title);
        $('#updateTaskDescription').val(desc);
        $('#updateStatusSelect').val(status);


        var taksIdCell = $('<td>').text(taskId);
        taksIdCell.attr('data-task-id', task
          .task_id);
        row.append(taksIdCell);

        var taskTitle = $('<td>').text(title);
        row.append(taskTitle);

        var taskDescription = $('<td>').text(desc);
        row.append(taskDescription);

        var statusMap = {
          'Done': 'text-success',
          'Ongoing': 'text-warning',
          'Cancelled': 'text-danger'
        };

        var taskStatus = $('<td>').addClass(statusMap[status] || 'text-secondary').text(status);
        row.append(taskStatus);

        var actions = $('<td>');
        actions.append(
          '<button class="btn btn-primary btn-sm mr-2 edit-btn"> <i class="fas fa-pencil-alt mr-2"></i>Edit Task</button>'
        );
        actions.append(
          '<button class="btn btn-danger btn-sm mr-2 delete-btn"> <i class="fas fa-trash-alt mr-2"></i>Delete</button>'
        );
        row.append(actions);

        taskTable.append(row);
      });
    }
  </script>

@stop

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class dataController extends Controller
{
    //

    function dashboard()
    {
        if (!Session::has('user_id')) {
            return view('login');
        }
        
        return view('pages/landing');
    }

    function loginPage()
    {
        if (!Session::has('user_id')) {
            return view('login');
        }
        
        return view('pages/landing');
    }

    function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
            ]);
        
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        
            if ($user->exists) {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'User registered successfully',
                ], 201);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to save user data',
                ], 500);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while registering the user',
            ], 500);
        }
    }
    
    function login(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
        
            $user = User::where('email', $request->email)->first();
        
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }
        
            Session::put('user_id', $user->id);
            //session()->put('user_id', $user->id);
        
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error logging in user: ' . $e->getMessage());
        }
    }

    function getTaskList()
    {
        $userId = session('user_id');

        
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
            return view('login');
        }

        // Retrieve tasks for the given user ID
        $tasks = Task::where('user_id', $userId)->get(['task_id', 'task_title', 'task_description', 'task_status']);

        if ($tasks->isEmpty())
        {
            return response()->json(['success' => false, 'message' => 'No record cannot be found'], 200);
        }
        // Return the tasks
        return response()->json(['success' => true, 'message' => 'Tasks Retrieved', 'data' => $tasks]);
    }

    function addTask(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $request->validate([
                'taskTitle' => 'required',
                'taskDescription' => 'required',
                'statusSelect' => 'required',
            ]);

            $userId = session('user_id');

            $task = Task::create([
                'task_title' => $request->taskTitle,
                'task_description' => $request->taskDescription,
                'task_status' => $request->statusSelect,
                'user_id' => $userId,
            ]);

            if (!$task)
            {
                throw new Exception('Error in saving this task!!');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Task saved successfully'], 200);
        }
        catch (\Exception $e)
        {
            DB:: rollback();
            return response()->json(['success' => false, 'message' => 'Error encountered: ' . $e->getMessage()]);
        }
    }

    function updateTask(Request $request, $taskId)
    {
        DB::beginTransaction();

        try
        {
            $task = task::find($taskId);

            if (!$task)
            {
                throw new Exception('Record cannot be found');
            }

            $task->task_title = $request->input('updateTaskTitle');
            $task->task_description = $request->input('updateTaskDescription');
            $task->task_status = $request->input('updateStatusSelect');

            $taskSave = $task->save();

            if (!$taskSave)
            {
                throw new Exception('Error in updating the task details!!!');
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Task successfully update'],200);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error encountered: ' . $e->getMessage()]);
        }
    }

    function deleteTask($taskId)
    {
        DB::beginTransaction();

        try
        {
            $task = task::find($taskId);

            if (!$task)
            {
                throw new Exception('Record cannot be found');
            }

            if($task->delete())
            {
                DB::commit();
                return response()->json(['success' => true, 'message' => 'Task successfully deleted: '], 200);    
            }
            else
            {
                throw new Exception('Record cannot be deleted!!!');
            }

        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(['success' => false, 'messge' => 'Error in deleting  the task: ' . $e->getMessage()]);
        }
    }
}

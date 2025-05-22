<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>to-do list web app</title>
</head>

<body>

    <h2>Add your task</h2>
    <form id="taskForm">
        <input type="text" id="task_description" name="task_description" placeholder="Add your Task">
        <input type="date" id="task_date">
        <input type="time" id="task_time">
        <button type="submit">Add</button>
    </form>

    <div id="massage" style="margin-top: 10px; font-weight: bold;"></div>

    <h3>My Tasks</h3>
    <p></p>
   {{--  <ul id="task-list">
        <li>Loading Tasks..</li>
    </ul> --}}
    <table border="1">
       <thead>
         <tr>
            <th>
                Task
            </th>
            <th>
                Due time
            </th>
            <th>
                Status
            </th>
            <th>
                Task button
            </th>
            <th>
                Task Deletion
            </th>
        </tr>
       </thead>

        <tbody id="task_body">
        <tr>
            <td id="task_details">loading...</td>
            <td id="task_due_time">loading...</td>
            <td id="task_status">loading...</td>
            <td><Button id="task_button">click</Button></td>
            <td><Button id="task_button">click</Button></td>
        </tr>
        </tbody>
    </table>

    <script src="{{asset('js/add_task.js')}}"></script>
    <script src="{{ asset('js/tasks.js') }}"></script>

</body>

</html>
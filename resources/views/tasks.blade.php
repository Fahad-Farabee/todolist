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
    <ul id="task-list">
        <li>Loading Tasks..</li>
    </ul>

    <script src="{{asset('js/add_task.js')}}"></script>
    <script src="{{ asset('js/tasks.js') }}"></script>

</body>

</html>
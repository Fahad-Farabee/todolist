document.addEventListener('DOMContentLoaded',function(){
    async function fetchTasks() {
        try{
            const response = await fetch('/api/tasks');
            const tasks = await response.json();

            const taskList = document.getElementById('task-list');
            taskList.innerHTML = ' ';
            
            if(tasks.length === 0){
                taskList.innerHTML = '<li>No tasks are available.</li>';
                return;
            }

            tasks.forEach(task=>{
                const li = document.createElement('li');
                li.textContent = `${task.task_details} -> Due date: ${task.due_date_time} -> Status: ${task.task_status ? 'done':'pending'}`;

                taskList.appendChild(li);
            });
        }catch(err){
            console.error('Error Loading Task: ',err);
        }
    }
    fetchTasks();
});
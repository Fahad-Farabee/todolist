document.addEventListener('DOMContentLoaded',()=>{
    const form = document.getElementById('taskForm');
    
    if(form){
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const task_details = document.getElementById('task_description');
            const task_date = document.getElementById('task_date');
            const task_time = document.getElementById('task_time');
            const msgBox = document.getElementById('massage');
            const response = await fetch('/api/add-task',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    task_details: task_details.value,
                    date: task_date.value,
                    time: task_time.value
                })
            });

            const result = await response.json();
            console.log(result);
            console.log(response);
            if(result.success){
                msgBox.innerText = result.msg || 'Task added!';
                msgBox.style.color = 'green';
                form.reset();
            }else{
            msgBox.innerText = result.msg || 'Something went wrong.';
            msgBox.style.color = 'red';
            }
        })
    }
})
document.addEventListener('DOMContentLoaded',function(){
    async function fetchTasks() {
        try{
            const response = await fetch('/api/tasks');
            const tasks = await response.json();
            const taskBody = document.getElementById('task_body');
            taskBody.innerHTML = '';

            if (tasks.length === 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td colspan="5">No tasks are available.</td>`;
                taskBody.appendChild(tr);
                return;
            }
            //taking each task.
            tasks.forEach(task=>{
                const tr = document.createElement('tr');
                const tdDetails = document.createElement('td');
                tdDetails.textContent = task.task_details;
                const tdDueTime = document.createElement('td');
                tdDueTime.textContent = task.due_date_time;
                const tdStatus = document.createElement('td');
                if(task.task_status){
                    tdStatus.textContent = 'complete';
                }else{
                    tdStatus.textContent = 'pending';
                }
                
                //for updating the task status.
                const tdActions = document.createElement('td');
                const btn = document.createElement('button');
                btn.textContent = 'click me';
                //making the  function for updating the status.
                btn.addEventListener('click',async()=>{//adding the event listener for clicking the button.
                    //doing the fetch.
                    try{
                        const updateResponse = await fetch(`/api/task-update/${task.id}`,{
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                task_status: !task.task_status 
                            })
                        });

                        if(updateResponse.ok){
                            fetchTasks();//this will refresh the task list.
                        }else{
                            updateResponse.msg;
                        }
                    }catch(error){
                        console.error('Error updating the task', error);
                    }

                });

                //for deleting a task.
                const tdDelete = document.createElement('td');
                const dltBtn = document.createElement('button');
                dltBtn.textContent = 'click me to delete';
                dltBtn.addEventListener('click',async()=>{
                    //doing the delete
                    try{
                        const dltResponse = await fetch(`/api/task-delete/${task.id}`,{
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                        });
                        if(dltResponse.ok){
                            fetchTasks()
                        }else{
                            dltResponse.msg;
                        }
                    }catch(error){
                        console.error('Error deleting the task', error);
                    }
                });


                tdActions.appendChild(btn);
                tdDelete.appendChild(dltBtn);
                tr.appendChild(tdDetails);
                tr.appendChild(tdDueTime);
                tr.appendChild(tdStatus);
                tr.appendChild(tdActions);
                tr.appendChild(tdDelete);
                taskBody.appendChild(tr);

            });
        }catch(err){
            console.error('Error Loading Task: ',err);
        }
    }
    fetchTasks();
});
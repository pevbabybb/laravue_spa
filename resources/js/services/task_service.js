import {http, httpFile} from './http_service';

export function createTask(data){
    return httpFile().post('api/task', data);
}

export function loadTasks(){
    return http().get('/task');
}

export function deleteTask(id){
    return http().delete(`task/${id}`) ;
}

export function updateTask(id,data){
    return http().post(`task/${id}`,data);
}


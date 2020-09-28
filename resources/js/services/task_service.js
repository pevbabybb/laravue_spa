import {http, httpFile} from './http_service';

export function createTask(data){
    return httpFile().post('api/task', data);
}

export function loadTasks(){
    return http().get('/task');
}
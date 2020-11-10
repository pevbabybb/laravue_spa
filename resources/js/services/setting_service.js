import {http, httpFile} from './http_service';
// export function updateTask(id,data){
//     return http().update(`task/${id}`,data);
// }

export function loadSetting(){
    return http().get('/setting');
}

export function updateSetting(id, data){
    return http().post(`/setting/${id}`,data);
}
import {http, httpFile} from './http_service';

export function loadRelation(){
    return http().get('/relation');
}

export function createRelation(data){
    return http().post('/relation', data);
}
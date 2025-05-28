import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class KeHoachService {
    constructor(private http: HttpClient) {}

    baseUrl = 'http://backend_dev.test/api/kehoach/';

    getData(): Observable<any> {
        console.log('aaaaaa');
        return this.http.get(`${this.baseUrl}`);
    }

    getDataById(id: string): Observable<any> {
        return this.http.get(`${this.baseUrl}${id}`);
    }

    saveData(data: any): Observable<any> {
        return this.http.post(`${this.baseUrl}create`, data);
    }
}

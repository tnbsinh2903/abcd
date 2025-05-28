import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class ThuongMaiServic {
    constructor(private http: HttpClient) {}
    baseUrl = 'http://backend_dev.test/api/thuongmai/';

    getAll(): Observable<any> {
        // console.log('rrrrrrr');
        return this.http.get(this.baseUrl);
    }
    search(search: any): Observable<any> {
        const params = new HttpParams().set('search', search);
        return this.http.get(this.baseUrl, { params });
    }

    saveEdit(data: any): Observable<any> {
        console.log(JSON.parse(data), 'kkkkkkkkkkko');
        return this.http.put(`${this.baseUrl}update`, JSON.parse(data));
    }

    deletedRow(data: any): Observable<any> {
        // console.log('🚀 ~ ThuongMaiServic ~ deletedRow ~ data:', data);
        return this.http.post(`${this.baseUrl}delete`, JSON.parse(data));

        return this.http.post(`${this.baseUrl}delete`, JSON.parse(data));
    }
}

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class NhanSuService {
    constructor(private http: HttpClient) {}

    baseUrl = 'http://backend_dev.test/api/nhanvien';

    getAll(): Observable<any> {
        return this.http.get(this.baseUrl);
    }
}

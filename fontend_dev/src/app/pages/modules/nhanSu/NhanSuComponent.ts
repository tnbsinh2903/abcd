import { OnInit, Component } from '@angular/core';
import { NhanSu } from '@fontend_dev/project/api-interface';
import { TableModule } from 'primeng/table';
import 'primeicons/primeicons.css';
import { PrimeIcons } from 'primeng/api';
import { CardModule } from 'primeng/card';
import { NhanSuService } from '../../service';
@Component({
    selector: ' app-nhan-su',
    templateUrl: './NhanSuComponent.html',
    styleUrls: ['./NhanSuComponent.scss'],
    imports: [TableModule]
})
export class NhanSuComponent implements OnInit {
    constructor(private nhanSuService: NhanSuService) {}
    ngOnInit(): void {
        this.loadData();
        throw new Error('Method not implemented.');
    }

    nhansu: NhanSu[] = [
        {
            id: 1,
            ho_ten: 'Nguyễn Văn A',
            email: 'sinh@gmail.com',
            sdt: '0123456789',
            dia_chi: 'Hà Nội',
            trang_thai: 'Đang làm việc',
            ma_so: 'NV001',
            id_chuc_vu: 1,
            id_bo_phan: 1,
            ngay_vao: '2023-01-01',
            ngay_sinh: '1990-01-01'
        }
    ];
    // nhansu: NhanSu[] = [];
    // console.log("🚀 ~ NhanSuComponent ~ nhansu:", this.nhansu);

    loadData() {
        this.nhanSuService.getAll().subscribe((response) => {
            this.nhansu = response;
            console.log('🚀 ~ NhanSuComponent ~ this.nhanSuService.getAll ~ response:', response);
        });
    }
}

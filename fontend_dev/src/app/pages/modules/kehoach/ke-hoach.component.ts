import { Component, OnInit } from '@angular/core';
import { Table, TableModule } from 'primeng/table';
import { IconFieldModule } from 'primeng/iconfield';
import { InputIconModule } from 'primeng/inputicon';
import { MultiSelectModule } from 'primeng/multiselect';
import { TagModule } from 'primeng/tag';
import { ProgressSpinnerModule } from 'primeng/progressspinner';
import { SelectModule } from 'primeng/select';
import { FormsModule } from '@angular/forms';
import { InputTextModule } from 'primeng/inputtext';
import { PaginatorModule } from 'primeng/paginator';
import { FileUploadEvent, FileUploadModule } from 'primeng/fileupload';
import { ButtonModule } from 'primeng/button';
import { ToastModule } from 'primeng/toast';
import { MessageService, ConfirmationService } from 'primeng/api';
import { CheckboxModule } from 'primeng/checkbox';
import { ConfirmDialogModule } from 'primeng/confirmdialog';
import { KeHoachService } from './ke-hoach.service';
import { DialogModule } from 'primeng/dialog';
import { DrawerModule } from 'primeng/drawer';
@Component({
    selector: 'app-ke-hoach',
    providers: [MessageService, ConfirmationService],
    imports: [
        ConfirmDialogModule,
        TableModule,
        IconFieldModule,
        InputIconModule,
        MultiSelectModule,
        TagModule,
        ProgressSpinnerModule,
        SelectModule,
        FormsModule,
        CheckboxModule,
        InputTextModule,
        PaginatorModule,
        FileUploadModule,
        ButtonModule,
        ToastModule,
        DialogModule,
        DrawerModule
    ],
    templateUrl: './ke-hoach.component.html',
    styleUrl: './ke-hoach.component.scss'
})
export class KeHoachComponent implements OnInit {
    constructor(
        private keHoachService: KeHoachService,
        private messageService: MessageService,
        private confirmationService: ConfirmationService
    ) {}

    ngOnInit(): void {
        console.log('pppppppppp, ');
        this.loadData();
    }

    dataAdd: any[] = [
        {
            id_thuong_mai: '',
            po: '',
            slhd_tong: '',
            slhd: '',
            size: ''
        }
    ];
    dataTM: any[] = [];
    dataKH: any[] = [];
    dataThuongMaiById: any[] = [];
    loading: boolean = false;
    first: number = 0;
    rows: number = 10;
    visible: boolean = false;
    visibleDrawer: boolean = false;
    visibleDrawerAddData: boolean = false;

    id_thuong_mai: string = '';

    loadData() {
        console.log('2213');
        this.loading = true;
        this.keHoachService.getData().subscribe((data: any) => {
            this.dataTM = data.data;
            console.log(data, 'data');
            this.loading = false;
        });
    }

    search(event: any) {}
    showTT(id: string) {
        this.id_thuong_mai = id;
        console.log(id, 'idddd');
        this.keHoachService.getDataById(id).subscribe((data: any) => {
            this.visibleDrawer = true;
            this.dataKH = data.ke_hoach;
            this.dataThuongMaiById = data.thuong_mai;
            console.log('🚀 ~ KeHoachComponent ~ this.keHoachService.getDataById ~ data:', this.dataKH);
        });
    }

    addRow() {
        this.dataAdd.unshift({
            id_thuong_mai: this.id_thuong_mai,
            po: '',
            slhd_tong: '',
            slhd: '',
            size: ''
        });
    }
    showAdd() {
        this.visibleDrawerAddData = true;
    }

    cancel_add() {
        this.visibleDrawerAddData = false;
        this.dataAdd = [
            {
                id_thuong_mai: this.id_thuong_mai,
                po: '',
                slhd_tong: '',
                slhd: '',
                size: ''
            }
        ];
    }

    save_data() {
        console.log(this.dataAdd, 'dataAdd');
        let data = JSON.stringify(this.dataAdd);
        this.keHoachService.saveData(data).subscribe((response: any) => {
            console.log(response, 'response');
        });
    }

    //  search(event: Event): void {
    //     let value = (event.target as HTMLInputElement).value;
    //     setTimeout(() => {
    //         this.thuongMaiService.search(value).subscribe((reponse: any) => {
    //             console.log(reponse, 'reponse');
    //             this.dataTM = reponse['data'];
    //         });
    //     }, 1000);
    // }
}
